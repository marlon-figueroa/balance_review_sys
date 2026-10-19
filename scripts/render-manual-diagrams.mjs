import { existsSync, mkdirSync, readFileSync, writeFileSync } from 'node:fs';
import { dirname, join } from 'node:path';
import { fileURLToPath } from 'node:url';

const root = join(dirname(fileURLToPath(import.meta.url)), '..');
const diagramsDir = join(root, 'docs/manual/diagrams');
const pngDir = join(root, 'docs/manual/png');
const krokiBase = process.env.KROKI_URL ?? 'https://kroki.io';

mkdirSync(pngDir, { recursive: true });

const files = [
    'flujo-estados.mmd',
    'arquitectura.mmd',
    'proceso-periodo.mmd',
    'roles.mmd',
    'despliegue.mmd',
];

const encabezadoNeo = "%%{init: {'theme':'neo','themeVariables':{'fontFamily':'DejaVu Sans, sans-serif'}}}%%\n";

for (const file of files) {
    const input = join(diagramsDir, file);
    const output = join(pngDir, file.replace(/\.mmd$/, '.png'));

    if (!existsSync(input)) {
        throw new Error(`Falta diagrama: ${input}`);
    }

    const fuente = encabezadoNeo + readFileSync(input, 'utf8');
    const respuesta = await fetch(`${krokiBase}/mermaid/png`, {
        method: 'POST',
        headers: { 'Content-Type': 'text/plain' },
        body: fuente,
    });

    if (!respuesta.ok) {
        const detalle = await respuesta.text();
        throw new Error(`Kroki falló (${respuesta.status}) para ${file}: ${detalle.slice(0, 200)}`);
    }

    writeFileSync(output, Buffer.from(await respuesta.arrayBuffer()));
    console.log(`OK ${output}`);
}

console.log(`Diagramas PNG (Mermaid tema neo) en ${pngDir}`);
