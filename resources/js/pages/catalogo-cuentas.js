import { serverTable } from '../libs/datatables';

const tableEl = document.getElementById('tabla-catalogo-cuentas');

if (tableEl) {
    serverTable(tableEl, {
        url: tableEl.dataset.url,
        order: [[0, 'asc']],
        columns: [
            { data: 'codigo', name: 'codigo' },
            { data: 'nombre', name: 'nombre' },
            { data: 'naturaleza', name: 'naturaleza', searchable: false },
            { data: 'es_corriente', name: 'es_corriente', searchable: false },
            { data: 'activa', name: 'activa', searchable: false },
            { data: 'acciones', orderable: false, searchable: false, className: 'acciones text-end' },
        ],
    });
}
