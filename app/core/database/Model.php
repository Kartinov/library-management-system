<?php

require_once 'Connection.php';

abstract class Model extends Connection
{
    protected array  $where = [];

    protected array  $orWhere = [];

    protected array $whereIn = [];

    protected array $joins = [];

    protected array $orderBy = [];

    protected string $table;

    protected string $selectRaw = '*';

    /**
     * Return all rows from the table.
     * 
     * @return array
     */
    public function all(): array
    {
        return $this->connection
            ->query("SELECT * FROM {$this->table};")
            ->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Insert data in the table.
     * 
     * @param  array $data
     * @return bool
     */
    public function create(array $data): bool
    {
        /**
         * @var array
         */
        $columns = array_keys($data);

        /**
         * @var string
         */
        $query = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $this->table,
            implode(",", $columns),
            substr(str_repeat('?, ', count($columns)), 0, -2)
        );

        return $this->connection
            ->prepare($query)
            ->execute(array_values($data));
    }

    /**
     * Update data in the table.
     * 
     * @param array $data
     * @return bool
     */
    public function update(array $data)
    {
        /**
         * @var string
         */
        $query = "UPDATE {$this->table} SET ";

        foreach ($data as $column => $value) {
            $query .= "{$column} = :{$column}, ";
        }

        $query = rtrim($query, ', '); // remove last (', ')

        if (count($this->where)) {

            $query .= " WHERE ";

            $count = 0;

            foreach ($this->where as $column => $value) {
                if ($count > 0) {
                    $query .= "AND ";
                }

                $query .= "{$column} = :$column ";
                $count++;
            }
        }

        $query = substr($query, 0, -1); // remove last char (space)

        return $this->connection
            ->prepare($query)
            ->execute($data);
    }

    /**
     * @param string $columnName
     * @param string $condition
     */
    public function delete(string $columnName, string $witch)
    {
        $query = "DELETE FROM {$this->table} WHERE $columnName = :condition";

        $stmt = $this->connection->prepare($query);
        $executed = $stmt->execute([
            'condition' => $witch
        ]);

        return $executed;
    }

    /**
     * @param array $conditions
     */
    public function where(array $conditions)
    {
        $this->where = array_merge($this->where, $conditions);

        return $this;
    }

    public function clearWhere()
    {
        $this->where = [];

        return $this;
    }

    public function orWhere(array $conditions)
    {
        $this->orWhere[] = $conditions;

        return $this;
    }

    public function whereIn(array $conditions)
    {
        $this->whereIn[] = $conditions;

        return $this;
    }

    public function orderBy($column, $order = 'ASC')
    {
        $this->orderBy[] = [strtolower($column), $order];

        return $this;
    }

    public function selectRaw(string $raw)
    {
        $this->selectRaw = $raw;

        return $this;
    }

    /**
     * @param string $table
     * @param string $column1
     * @param string $operator
     * @param string $column2
     */
    public function join($table, $column1, $operator, $column2)
    {
        $this->joins[] = [$table, $column1, $operator, $column2];

        return $this;
    }

    /**
     * @return bool
     */
    public function exists(): bool
    {
        $query = "SELECT EXISTS(SELECT 1 FROM {$this->table} WHERE ";

        foreach ($this->where as $column => $value) {
            $query .= "{$column} = :$column ";
        }

        $query = substr($query, 0, -1); // remove last char (space)

        $query .= ');';

        $stmt = $this->connection->prepare($query);
        $stmt->execute($this->where);

        return $stmt->fetchColumn();
    }

    public function get()
    {
        $query = "SELECT {$this->selectRaw} FROM {$this->table} ";

        if (count($this->joins)) {
            foreach ($this->joins as $join) {
                $query .= "JOIN {$join[0]} ON {$join[1]} {$join[2]} {$join[3]} ";
            }
        }

        if (count($this->where)) {

            $query .= "WHERE ";

            $count = 0;

            foreach ($this->where as $column => $value) {
                if ($count > 0) {
                    $query .= "AND ";
                }

                $query .= "{$column} = :$column ";
                $count++;
            }

            $query = substr($query, 0, -1); // remove last char (space)

        } elseif (count($this->orWhere)) {

            $query .= "WHERE ";

            $count = 0;

            foreach ($this->orWhere as $condition) {
                if ($count > 0) {
                    $query .= ' OR';
                }

                $query .= sprintf(' %s %s :%s', $condition[0], $condition[1], str_replace('.', '_', $condition[0]));
                $count++;
            }
        } elseif (count($this->whereIn)) {

            $selectedCategories = implode(',', $this->whereIn[0][1]);

            $query .= "WHERE {$this->whereIn[0][0]} IN ({$selectedCategories})";
        }

        if (!empty($this->orderBy)) {
            $query .= " ORDER BY {$this->orderBy[0][0]} {$this->orderBy[0][1]}";
        }

        $query .= ';';

        $stmt = $this->connection->prepare($query);

        if ($this->orWhere) {
            foreach ($this->orWhere as $condition) {
                $stmt->bindValue(str_replace('.', '_', $condition[0]), $condition[2]);
            }

            $stmt->execute();
        } elseif ($this->where) {
            $stmt->execute($this->where);
        } else {
            $stmt->execute();
        }

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function first()
    {
        $query = "SELECT * FROM {$this->table} ";

        if (count($this->where)) {

            $query .= "WHERE ";

            $count = 0;

            foreach ($this->where as $column => $value) {
                if ($count > 0) {
                    $query .= "AND ";
                }

                $query .= "{$column} = :$column ";
                $count++;
            }
        }

        $query = substr($query, 0, -1); // remove last char (space)

        $query .= ' LIMIT 1;';

        $stmt = $this->connection->prepare($query);
        $executed = $stmt->execute($this->where);

        if ($executed) {
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        return false;
    }
}
