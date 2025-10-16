<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../styles.css">
  <title>Nuevo Restaurante</title>
</head>
<body>
  <header>
    <h1>➕ Nuevo Restaurante</h1>
    <nav><a href="restaurantes.php" class="btn">← Volver</a></nav>
  </header>

  <main>
    <form id="formRestaurante">
      <label>Nombre:</label>
      <input type="text" name="nombre" required><br><br>
      <label>Dirección:</label>
      <input type="text" name="direccion"><br><br>
      <label>Tipo de Comida:</label>
      <input type="text" name="tipo_comida"><br><br>
      <button class="btn-new" type="submit">Guardar</button>
    </form>
  </main>

  <script>
    const API_URL = "http://localhost:8000/restaurantes";

    document.getElementById("formRestaurante").addEventListener("submit", async (e) => {
      e.preventDefault();
      const data = Object.fromEntries(new FormData(e.target).entries());
      await fetch(API_URL, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
      });
      alert("Restaurante creado correctamente");
      window.location = "restaurantes.php";
    });
  </script>
</body>
</html>
