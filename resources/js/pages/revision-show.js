import { initDiagramaEstados } from '../libs/diagrama-estados';
import { initFormulariosFlujo } from '../libs/flujo';

initFormulariosFlujo();

const datosDiagrama = document.getElementById('diagrama-estados-datos');

if (datosDiagrama) {
    initDiagramaEstados(document.getElementById('diagrama-estados'), JSON.parse(datosDiagrama.textContent));
}
