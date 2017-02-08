<?php

class conectarDB {

//    private $dbHost = "altamira.desarrollosdvs.cl";
//    private $dbUsername = "desarro4_dvs";
//    private $dbPassword = "flux2015121GW";
//    private $dbName = "desarro4_altamira";
    private $dbHost = "localhost";
    private $dbUsername = "altamira_dgo";
    private $dbPassword = "dgoiquique123";
    private $dbName = "altamira_new";
    public $db;

    public function __construct() {
        if (!isset($this->db)) {
            try {
                $conn = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName . ";charset=utf8", $this->dbUsername, $this->dbPassword);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                mysqli_set_charset($conn, "utf8");
                $this->db = $conn;
                error_log("Conectado correctamente");
            } catch (PDOException $e) {
                error_log("Error al conectar a la base de datos" . print_r($e->getMessage(), true));
                die("Failed to connect to Mysql:" . $e->getMessage());
            }
        }
    }

    public function getDestacados() {
        $sql = 'SELECT p2.codigo,p2.titulo,strip_tags(p2.descrip) as descrip,p2.uf,p2.clp,p2.tipo,p2.construido,p2.dormitorio,p2.ban,p2.comuna,p2.mapa,p2.direccion_real,p2.terreno, ';
        $sql .= "substring(p.url,46) as id_prop,f.numero ";
        $sql .= ' FROM propaganda p left join fotos f on f.id_prop = substring(p.url,46) and f.id_ft = (select min(f2.id_ft) from fotos f2 where f2.id_prop = f.id_prop) ';
        $sql .= ' left join propiedad p2 on f.id_prop = p2.id_prop ';

        error_log(print_r($sql, TRUE));

        $query = $this->db->prepare($sql);
        $query->execute();

        if ($query->rowCount() > 0) {
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
        }

        $res = array("resultado" => $data);

        return !empty($data) ? $res : false;
    }

    public function getRows($table, $conditions = array()) {
        $sql = 'SELECT ';
        $sql .= "codigo,titulo,strip_tags(descrip) as descrip,direccion_real,dire,tipo,comuna,clp,uf,construido,terreno,dormitorio,ban,mapa,operacion,ifnull(f.numero,0) as numero,ifnull(p.id_prop,0) as id_prop";
        $sql .= ' FROM ' . $table . ' p left join fotos f on f.id_prop = p.id_prop and f.id_ft = (select min(f2.id_ft) from fotos f2 where f2.id_prop = f.id_prop) ';

        $sql .= ' WHERE estado = 1 ';


        if (array_key_exists("where", $conditions)) {
            $i = 0;
            foreach ($conditions['where'] as $key => $value) {
                if ($key == "tipo" && $value == "-1") {
                    $sql .= ' AND ' . filter_var($key, FILTER_SANITIZE_STRING) . " not in (1,2,4)";
                    $i++;
                } else if ($value != "") {
                    $sql .= ' AND ' . filter_var($key, FILTER_SANITIZE_STRING) . " = '" . filter_var($value, FILTER_SANITIZE_STRING) . "'";
                    $i++;
                }
            }
        }

        if (array_key_exists("notequals", $conditions)) {
            $i = 0;
            foreach ($conditions['notequals'] as $key => $value) {
                $sql .= ' AND ' . filter_var($key, FILTER_SANITIZE_STRING) . " <> '" . filter_var($value, FILTER_SANITIZE_STRING) . "'";
                $i++;
            }
        }

        if (array_key_exists("whereLike", $conditions)) {
            $i = 0;
            foreach ($conditions['whereLike'] as $key => $value) {
                $sql .= ' AND ' . filter_var($key, FILTER_SANITIZE_STRING) . " LIKE '%" . filter_var($value, FILTER_SANITIZE_STRING) . "%'";
                $i++;
            }
        }

        if (array_key_exists("precio", $conditions)) {
            $precio = $conditions['precio'];
            if (!is_null($precio['desde']) && trim($precio['desde']) <> "") {
                $sql .= ' AND ' . filter_var($precio['tipo'], FILTER_SANITIZE_STRING) . " >= " . filter_var($precio['desde'], FILTER_SANITIZE_NUMBER_INT);
            }
            if (!is_null($precio['hasta']) && trim($precio['hasta']) <> "") {
                $sql .= ' AND ' . filter_var($precio['tipo'], FILTER_SANITIZE_STRING) . " <= " . filter_var($precio['hasta'], FILTER_SANITIZE_NUMBER_INT);
            }
            $i++;
        }

        $sql .= ' ORDER BY uf,clp asc ';

        if (array_key_exists("order by", $conditions)) {
            $sql .= ' ORDER BY ' . filter_var($conditions['order_by'], FILTER_SANITIZE_STRING);
        }

        $tmp = $this->db->prepare($sql);
        $tmp->execute();
        $total = $tmp->rowCount();

        if (array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)) {
            $sql .= ' LIMIT ' . filter_var($conditions['start'], FILTER_SANITIZE_NUMBER_INT) . ',' . filter_var($conditions['limit'], FILTER_SANITIZE_NUMBER_INT);
        } elseif (!array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)) {
            $sql .= ' LIMIT ' . filter_var($conditions['limit'], FILTER_SANITIZE_NUMBER_INT);
        }
        $query = $this->db->prepare($sql);
        $query->execute();

        if (array_key_exists("return_type", $conditions) && $conditions['return_type'] != 'all') {
            switch ($conditions['return_type']) {
                case 'count':
                    $data = $query->rowCount();
                    break;
                case 'single':
                    $data = $query->fetch(PDO::FETCH_ASSOC);
                    break;
                default:
                    $data = '';
            }
        } else {
            if ($query->rowCount() > 0) {
                $data = $query->fetchAll(PDO::FETCH_ASSOC);
            }
        }

        $res = array("resultado" => $data, "total" => $total);

        return !empty($data) ? $res : false;
    }

    public function getFotos($table, $conditions = array()) {
        $sql = 'SELECT ';
        $sql .= 'numero,id_prop';
        $sql .= ' FROM ' . $table;

        error_log("select DB:" . $conditions['select']);

        $sql .= ' WHERE 1 = 1 ';

        if (array_key_exists("where", $conditions)) {
            $i = 0;
            foreach ($conditions['where'] as $key => $value) {
                $sql .= ' AND ' . filter_var($key, FILTER_SANITIZE_STRING) . " = '" . filter_var($value, FILTER_SANITIZE_STRING) . "'";
                $i++;
            }
        }

        if (array_key_exists("notequals", $conditions)) {
            $i = 0;
            foreach ($conditions['notequals'] as $key => $value) {
                $sql .= ' AND ' . filter_var($key, FILTER_SANITIZE_STRING) . " <> '" . filter_var($value, FILTER_SANITIZE_STRING) . "'";
                $i++;
            }
        }

        if (array_key_exists("whereLike", $conditions)) {
            $i = 0;
            foreach ($conditions['whereLike'] as $key => $value) {
                $sql .= ' AND ' . filter_var($key, FILTER_SANITIZE_STRING) . " LIKE '%" . filter_var($value, FILTER_SANITIZE_STRING) . "%'";
                $i++;
            }
        }


        if (array_key_exists("order_by", $conditions)) {
            $sql .= ' ORDER BY ' . filter_var($conditions['order_by'], FILTER_SANITIZE_STRING);
        }

        error_log(print_r($sql, TRUE));

        $tmp = $this->db->prepare($sql);
        $tmp->execute();
        $total = $tmp->rowCount();

        if (array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)) {
            $sql .= ' LIMIT ' . filter_var($conditions['start'], FILTER_SANITIZE_NUMBER_INT) . ',' . filter_var($conditions['limit'], FILTER_SANITIZE_NUMBER_INT);
        } elseif (!array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)) {
            $sql .= ' LIMIT ' . filter_var($conditions['limit'], FILTER_SANITIZE_NUMBER_INT);
        }
        $query = $this->db->prepare($sql);
        $query->execute();

        if (array_key_exists("return_type", $conditions) && $conditions['return_type'] != 'all') {
            switch ($conditions['return_type']) {
                case 'count':
                    $data = $query->rowCount();
                    break;
                case 'single':
                    $data = $query->fetch(PDO::FETCH_ASSOC);
                    break;
                default:
                    $data = '';
            }
        } else {
            if ($query->rowCount() > 0) {
                $data = $query->fetchAll(PDO::FETCH_ASSOC);
            }
        }

        $res = array("resultado" => $data, "total" => $total);

        return !empty($data) ? $res : false;
    }

    function mysqlCleaner($data) {
        $dataTmp = mysql_real_escape_string($data);
        $dataTmp2 = stripslashes($dataTmp);
        return $data;
        //or in one line code 
        //return(stripslashes(mysql_real_escape_string($data)));
    }

}
