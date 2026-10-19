# Manual del sistema (PDF)

Diagramas en [diagrams/](diagrams/) con **tema Mermaid `neo`**. Los PNG para el PDF se generan en [png/](png/) vía [Kroki](https://kroki.io) (`npm run docs:diagrams`, requiere red).

```bash
npm run docs:diagrams
php artisan docs:manual-proyecto-pdf
```

Salida por defecto: `docs/manual/manual-sistema.pdf`.

Descarga web (usuario autenticado con `revisiones.ver`): `/docs/manual-sistema.pdf`.
