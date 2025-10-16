<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../styles.css">
  <title>Editar Lugar</title>
</head>
<body>
  <header>
    <h1>✏️ Editar Lugar</h1>
    <nav><a href="lugares.php" class="btn">← Volver</a></nav>
  </header>

  <main>
    <form id="formEditar">
      <input type="hidden" name="id" id="id">
      <label>Nombre:</label>
      <input type="text" name="nombre" id="nombre" required><br><br>
      <label>Descripción:</label>
      <textarea name="descripcion" id="descripcion"></textarea><br><br>
      <label>Ubicación:</label>
      <input type="text" name="ubicacion" id="ubicacion"><br><br>
      <button class="btn-new" type="submit">Actualizar</button>
    </form>
  </main>

  <script>
    const params = new URLSearchParams(window.location.search);
    const id = params.get("id");
    const API_URL = `http://localhost:8000/lugares/${id}`;

    async function cargarDatos() {
      const res = await fetch(API_URL);
      const data = await res.json();
      document.getElementById("id").value = data.id;
      document.getElementById("nombre").value = data.nombre;
      document.getElementById("descripcion").value = data.descripcion;
      document.getElementById("ubicacion").value = data.ubicacion;
    }

    document.getElementById("formEditar").addEventListener("submit", async (e) => {
      e.preventDefault();
      const datos = Object.fromEntries(new FormData(e.target).entries());
      await fetch(API_URL, {
        method: "PATCH",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(datos)
      });
      alert("Lugar actualizado correctamente");
      window.location = "lugares.php";
    });

    cargarDatos();
  </script>
</body>
</html>
