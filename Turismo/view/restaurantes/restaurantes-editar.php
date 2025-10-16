<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../styles.css">
  <title>Editar Restaurante</title>
</head>
<body>
  <header>
    <h1>✏️ Editar Restaurante</h1>
    <nav><a href="restaurantes.php" class="btn">← Volver</a></nav>
  </header>

  <main>
    <form id="formEditar">
      <input type="hidden" name="id" id="id">
      <label>Nombre:</label>
      <input type="text" name="nombre" id="nombre" required><br><br>
      <label>Dirección:</label>
      <input type="text" name="direccion" id="direccion"><br><br>
      <label>Tipo de Comida:</label>
      <input type="text" name="tipo_comida" id="tipo_comida"><br><br>
      <button class="btn-new" type="submit">Actualizar</button>
    </form>
  </main>

  <script>
    const params = new URLSearchParams(window.location.search);
    const id = params.get("id");
    const API_URL = `http://localhost:8000/restaurantes/${id}`;

    async function cargarDatos() {
      const res = await fetch(API_URL);
      const data = await res.json();
      document.getElementById("id").value = data.id;
      document.getElementById("nombre").value = data.nombre;
      document.getElementById("direccion").value = data.direccion;
      document.getElementById("tipo_comida").value = data.tipo_comida;
    }

    document.getElementById("formEditar").addEventListener("submit", async (e) => {
      e.preventDefault();
      const datos = Object.fromEntries(new FormData(e.target).entries());
      await fetch(API_URL, {
        method: "PATCH",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(datos)
      });
      alert("Restaurante actualizado correctamente");
      window.location = "restaurantes.php";
    });

    cargarDatos();
  </script>
</body>
</html>
