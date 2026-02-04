class Producto {
    private $conexion;
    public function __construct($conexion) { $this->conexion = $conexion; }

    public function getAll() {
        return $this->conexion->query("SELECT * FROM productos");
    }

    public function getById($id) {
        $stmt = $this->conexion->prepare("SELECT * FROM productos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($nombre, $precio, $estado) {
        $stmt = $this->conexion->prepare("INSERT INTO productos(nombre, precio, estado) VALUES(?,?,?)");
        $stmt->bind_param("sds", $nombre, $precio, $estado);
        return $stmt->execute();
    }

    public function update($id, $nombre, $precio, $estado) {
        $stmt = $this->conexion->prepare("UPDATE productos SET nombre=?, precio=?, estado=? WHERE id=?");
        $stmt->bind_param("sdsi", $nombre, $precio, $estado, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conexion->prepare("DELETE FROM productos WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
