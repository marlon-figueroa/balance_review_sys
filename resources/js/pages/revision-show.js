import { initDiagramaEstados } from '../libs/diagrama-estados';

const datosDiagrama = document.getElementById('diagrama-estados-datos');

if (datosDiagrama) {
    initDiagramaEstados(document.getElementById('diagrama-estados'), JSON.parse(datosDiagrama.textContent));
}
