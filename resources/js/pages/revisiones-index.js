import { serverTable } from '../libs/datatables';

const tableEl = document.getElementById('tabla-revisiones');

if (tableEl) {
    serverTable(tableEl, {
        url: tableEl.dataset.url,
        order: [[0, 'desc']],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'periodo', name: 'mes', searchable: false },
            { data: 'estado', name: 'estado' },
            { data: 'creador', name: 'creador.name', orderable: false },
            { data: 'integridad_ok', name: 'integridad_ok', searchable: false },
            { data: 'acciones', orderable: false, searchable: false, className: 'acciones text-end' },
        ],
    });
}
