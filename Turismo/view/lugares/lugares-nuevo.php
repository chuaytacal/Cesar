<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../styles.css">
  <title>Nuevo Lugar</title>
</head>
<body>
  <header>
    <h1>➕ Nuevo Lugar</h1>
    <nav><a href="lugares.php" class="btn">← Volver</a></nav>
  </header>

  <main>
    <form id="formLugar">
      <label>Nombre:</label>
      <input type="text" name="nombre" required><br><br>
      <label>Descripción:</label>
      <textarea name="descripcion"></textarea><br><br>
      <label>Ubicación:</label>
      <input type="text" name="ubicacion"><br><br>
      <button class="btn-new" type="submit">Guardar</button>
    </form>
  </main>

  <script>
    const API_URL = "http://localhost:8000/lugares";

    document.getElementById("formLugar").addEventListener("submit", async (e) => {
      e.preventDefault();
      const data = Object.fromEntries(new FormData(e.target).entries());
      await fetch(API_URL, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
      });
      alert("Lugar creado correctamente");
      window.location = "lugares.php";
    });
  </script>
</body>
</html>
