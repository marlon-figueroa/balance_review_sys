import { execFileSync } from 'node:child_process';
import { existsSync, mkdirSync } from 'node:fs';
import { dirname, join } from 'node:path';
import { fileURLToPath } from 'node:url';

const root = join(dirname(fileURLToPath(import.meta.url)), '..');
const diagramsDir = join(root, 'docs/manual/diagrams');
const svgDir = join(root, 'docs/manual/svg');
const config = join(root, 'docs/manual/mermaid-config.json');

mkdirSync(svgDir, { recursive: true });

const files = [
    'flujo-estados.mmd',
    'arquitectura.mmd',
    'proceso-periodo.mmd',
    'roles.mmd',
    'despliegue.mmd',
];

const mmdc = join(root, 'node_modules/.bin/mmdc');

for (const file of files) {
    const input = join(diagramsDir, file);
    const output = join(svgDir, file.replace(/\.mmd$/, '.svg'));

    if (!existsSync(input)) {
        throw new Error(`Falta diagrama: ${input}`);
    }

    execFileSync(mmdc, [
        '-i', input,
        '-o', output,
        '-c', config,
        '-b', 'transparent',
    ], { stdio: 'inherit', cwd: root });
}

console.log(`Diagramas SVG generados en ${svgDir}`);
