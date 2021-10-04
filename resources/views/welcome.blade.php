<!DOCTYPE html>
<html lang="en">
  <head>
<link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist@latest/swagger-ui.css">
<script src="https://unpkg.com/swagger-ui-dist@latest/swagger-ui-bundle.js"></script>
  </head>

  <body>

<div id="swagger-ui"></div>

<script>
    window.onload = function () {
        window.ui = SwaggerUIBundle({
            url: window.location.protocol + "//" + window.location.hostname + ":" + window.location.port + "/swagger/swagger.yaml",
            dom_id: '#swagger-ui',
            deepLinking: true,
            presets: [
                SwaggerUIBundle.presets.apis,
            ],
            layout: 'BaseLayout',
        });
    };
</script>
  </body>
</html>