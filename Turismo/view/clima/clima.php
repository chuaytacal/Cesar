<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../styles.css">
  <title>Clima Actual</title>
</head>
<body>
  <header>
    <h1>🌤️ Clima Actual - Tacna</h1>
    <nav>
      <a href="../index.html" class="btn">Inicio</a>
      <a href="../lugares/lugares.php" class="btn">Lugares</a>
      <a href="../restaurantes/restaurantes.php" class="btn">Restaurantes</a>
    </nav>
  </header>

  <main>
    <div id="card-clima" class="card" style="max-width:400px;margin:auto;text-align:center;">
      <p>Cargando clima...</p>
    </div>
  </main>

  <script>
    const API_URL = "http://localhost:8000/clima";

    async function cargarClima() {
      const res = await fetch(API_URL);
      const data = await res.json();
      const card = document.getElementById("card-clima");
      card.innerHTML = `
        <h2>${data.ciudad}</h2>
        <p><strong>Temperatura:</strong> ${data.temperatura}</p>
        <p><strong>Descripción:</strong> ${data.descripcion}</p>
      `;
    }

    cargarClima();
  </script>
</body>
</html>
