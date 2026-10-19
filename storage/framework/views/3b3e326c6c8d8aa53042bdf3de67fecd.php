<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Manual del sistema — <?php echo e(config('app.name')); ?></title>
    <style>
        @page { margin: 22mm 18mm 28mm 18mm; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 11pt; color: #212529; line-height: 1.45; }
        h1, h2, h3 { color: <?php echo e(config('branding.primary')); ?>; page-break-after: avoid; }
        h2 { font-size: 15pt; margin-top: 18pt; border-bottom: 2px solid <?php echo e(config('branding.primary')); ?>; padding-bottom: 4pt; }
        h3 { font-size: 12pt; margin-top: 12pt; }
        p { margin: 0 0 8pt; text-align: justify; }
        ul, ol { margin: 0 0 10pt 18pt; }
        li { margin-bottom: 4pt; }
        .salto { page-break-before: always; }
        .portada {
            page-break-after: always;
            text-align: center;
            padding-top: 55mm;
            min-height: 240mm;
        }
        .portada__marca {
            font-size: 11pt;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #6c757d;
            margin-bottom: 24pt;
        }
        .portada__titulo {
            font-size: 26pt;
            font-weight: bold;
            color: <?php echo e(config('branding.primary')); ?>;
            margin: 0 0 12pt;
            line-height: 1.2;
        }
        .portada__subtitulo { font-size: 14pt; color: #495057; margin-bottom: 36pt; }
        .portada__meta { font-size: 11pt; color: #6c757d; margin-top: 48pt; }
        .portada__linea {
            width: 45%;
            height: 3px;
            background: <?php echo e(config('branding.primary')); ?>;
            margin: 28pt auto;
        }
        .contraportada {
            page-break-before: always;
            text-align: center;
            padding-top: 70mm;
            min-height: 240mm;
            font-size: 10pt;
            color: #6c757d;
        }
        .contraportada strong { color: #212529; display: block; margin-bottom: 8pt; font-size: 11pt; }
        .indice { page-break-after: always; }
        .indice h2 { border: none; }
        .indice ol { list-style: none; margin-left: 0; padding-left: 0; }
        .indice li { border-bottom: 1px dotted #ced4da; padding: 6pt 0; }
        .indice a { color: #212529; text-decoration: none; }
        .diagrama-manual { margin: 12pt 0 16pt; page-break-inside: avoid; }
        .diagrama-manual__titulo { font-weight: bold; font-size: 10pt; margin-bottom: 6pt; color: #495057; }
        .diagrama-manual__img { text-align: center; }
        .diagrama-manual__img img { max-width: 100%; height: auto; }
        .diagrama-manual__leyenda { font-size: 9pt; color: #6c757d; margin-top: 6pt; font-style: italic; }
        .diagrama-manual__faltante { font-size: 9pt; color: #856404; background: #fff3cd; padding: 8pt; border: 1px solid #ffecb5; }
        table.roles { width: 100%; border-collapse: collapse; margin: 10pt 0; font-size: 10pt; }
        table.roles th { background: <?php echo e(config('branding.primary')); ?>; color: #fff; padding: 6pt; text-align: left; }
        table.roles td { border: 1px solid #dee2e6; padding: 6pt; vertical-align: top; }
        .aviso-diagramas {
            background: #e7f1ff;
            border: 1px solid #b6d4fe;
            padding: 8pt;
            margin-bottom: 12pt;
            font-size: 9pt;
        }
    </style>
</head>
<body>
    <?php
        $generadoEn = $generadoEn ?? now();
    ?>

    <section class="portada">
        <div class="portada__marca"><?php echo e(config('app.name')); ?></div>
        <div class="portada__linea"></div>
        <h1 class="portada__titulo">Manual del sistema</h1>
        <p class="portada__subtitulo">Revisión de balance contable — MVP</p>
        <p class="portada__meta">
            Documento descriptivo del funcionamiento,<br>
            roles, flujos y arquitectura técnica<br><br>
            Generado el <?php echo e($generadoEn->format('d/m/Y H:i')); ?>

        </p>
    </section>

    <section class="indice" id="indice">
        <h2>Índice</h2>
        <ol>
            <li><a href="#intro">1. Introducción y propósito</a></li>
            <li><a href="#alcance">2. Alcance del MVP</a></li>
            <li><a href="#roles">3. Roles y segregación de funciones</a></li>
            <li><a href="#flujo">4. Flujo de estados del periodo</a></li>
            <li><a href="#proceso">5. Proceso funcional por periodo</a></li>
            <li><a href="#modulos">6. Módulos principales</a></li>
            <li><a href="#arquitectura">7. Arquitectura de componentes</a></li>
            <li><a href="#despliegue">8. Despliegue con Podman</a></li>
            <li><a href="#salidas">9. Salidas y reportes</a></li>
        </ol>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($faltanDiagramas ?? false): ?>
            <p class="aviso-diagramas">
                Nota: algunos diagramas Mermaid (tema neo) no están embebidos. Genere los SVG con
                <strong>npm run docs:diagrams</strong> antes de exportar el PDF.
            </p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </section>

    <section id="intro">
        <h2>1. Introducción y propósito</h2>
        <p>
            El sistema <strong><?php echo e(config('app.name')); ?></strong> modela la revisión de balance como un
            subsistema de control financiero: ingiere datos contables, valida integridad, registra hallazgos
            y ajustes, y somete cada periodo a un flujo de aprobación con trazabilidad hasta la certificación.
        </p>
        <p>
            Está construido como MVP sobre <strong>Laravel 12</strong>, interfaz <strong>Bootstrap 5</strong>,
            persistencia <strong>MySQL</strong> y despliegue local con <strong>Podman Compose</strong>.
        </p>
    </section>

    <section id="alcance" class="salto">
        <h2>2. Alcance del MVP</h2>
        <ul>
            <li>Periodos contables (mes/año) con estados: borrador, en revisión, aprobado y certificado.</li>
            <li>Catálogo maestro de cuentas y carga de balanza vía CSV o datos demostrativos.</li>
            <li>Validación de integridad contable (activo = pasivo + patrimonio).</li>
            <li>Conciliaciones, hallazgos, ajustes contables y cálculo de KPIs.</li>
            <li>Diagrama de estados interactivo (JointJS) e historial de transiciones.</li>
            <li>Reporte PDF del periodo certificado y bitácora de seguridad (módulo base).</li>
        </ul>
    </section>

    <section id="roles">
        <h2>3. Roles y segregación de funciones</h2>
        <p>
            La segregación impide que quien registra la balanza certifique el balance. Los permisos se
            gestionan con Spatie Laravel Permission.
        </p>
        <?php echo $__env->make('pdf.partials.diagrama-manual', [
            'imagen' => $diagramas['roles'] ?? null,
            'titulo' => 'Diagrama 1 — Roles y cadena de responsabilidad (Mermaid, tema neo)',
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <table class="roles">
            <thead>
                <tr><th>Rol</th><th>Responsabilidad principal</th></tr>
            </thead>
            <tbody>
                <tr><td>Registrador</td><td>Crea periodos, importa balanza, conciliaciones, envía a revisión.</td></tr>
                <tr><td>Revisor</td><td>Revisa integridad y hallazgos; aprueba o rechaza con motivo.</td></tr>
                <tr><td>Aprobador</td><td>Aprueba y certifica el balance (no puede ser el creador del periodo).</td></tr>
                <tr><td>Gerencia</td><td>Consulta periodos certificados y descarga reportes PDF.</td></tr>
                <tr><td>Administrador</td><td>Usuarios, roles, permisos y auditoría del sistema base.</td></tr>
            </tbody>
        </table>
    </section>

    <section id="flujo" class="salto">
        <h2>4. Flujo de estados del periodo</h2>
        <p>
            Cada transición queda registrada en <em>revision_historial</em>. Los rechazos devuelven el periodo
            a borrador para corrección y nuevo envío.
        </p>
        <?php echo $__env->make('pdf.partials.diagrama-manual', [
            'imagen' => $diagramas['flujo_estados'] ?? null,
            'titulo' => 'Diagrama 2 — Máquina de estados UML (Mermaid, tema neo)',
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </section>

    <section id="proceso">
        <h2>5. Proceso funcional por periodo</h2>
        <?php echo $__env->make('pdf.partials.diagrama-manual', [
            'imagen' => $diagramas['proceso_periodo'] ?? null,
            'titulo' => 'Diagrama 3 — Pipeline de revisión (Mermaid, tema neo)',
            'leyenda' => 'La integridad debe cumplirse antes de enviar a revisión.',
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </section>

    <section id="modulos" class="salto">
        <h2>6. Módulos principales</h2>
        <h3>6.1 Catálogo de cuentas</h3>
        <p>Plan de cuentas demostrativo, exportación CSV y uso como origen de líneas de balanza en periodo borrador.</p>
        <h3>6.2 Balanza e integridad</h3>
        <p>Importación CSV (codigo, naturaleza, debe, haber, saldo) con validación contra catálogo y totales por naturaleza.</p>
        <h3>6.3 Conciliaciones y hallazgos</h3>
        <p>Registro de diferencias bancarias y observaciones con severidad para el informe de revisión.</p>
        <h3>6.4 Ajustes contables</h3>
        <p>Propuestas de corrección con aprobación; solo los aprobados aparecen en el PDF certificado.</p>
        <h3>6.5 KPIs</h3>
        <p>Liquidez corriente, endeudamiento y capital de trabajo calculados al procesar la balanza.</p>
    </section>

    <section id="arquitectura">
        <h2>7. Arquitectura de componentes</h2>
        <?php echo $__env->make('pdf.partials.diagrama-manual', [
            'imagen' => $diagramas['arquitectura'] ?? null,
            'titulo' => 'Diagrama 4 — Vista lógica (Mermaid, tema neo)',
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <p>
            La capa web usa Vite para empaquetar JavaScript (DataTables, diagrama JointJS, SweetAlert2).
            Los reportes PDF se generan con DomPDF a partir de vistas Blade.
        </p>
    </section>

    <section id="despliegue" class="salto">
        <h2>8. Despliegue con Podman</h2>
        <?php echo $__env->make('pdf.partials.diagrama-manual', [
            'imagen' => $diagramas['despliegue'] ?? null,
            'titulo' => 'Diagrama 5 — Contenedores (Mermaid, tema neo)',
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <p>
            Tres servicios: <strong>app</strong> (PHP-FPM), <strong>nginx</strong> (puerto 8080) y
            <strong>mysql</strong> (3307 en el host). El directorio <code>public/build</code> se monta
            desde el host tras <code>npm run build</code> para alinear manifest y assets estáticos.
        </p>
    </section>

    <section id="salidas">
        <h2>9. Salidas y reportes</h2>
        <ul>
            <li>Balance certificado con totales, hallazgos, KPIs y ajustes aprobados (PDF por periodo).</li>
            <li>Diagrama de estados con pasos del historial (pantalla y modal en detalle del periodo).</li>
            <li>Bitácora de accesos y cambios administrativos (módulo heredado del gestor base).</li>
        </ul>
        <p>
            Este manual puede regenerarse con <code>php artisan docs:manual-proyecto-pdf</code> o descargarse
            desde la ruta autenticada <code>/docs/manual-sistema.pdf</code>.
        </p>
    </section>

    <section class="contraportada">
        <strong><?php echo e(config('app.name')); ?></strong>
        Manual del sistema — Revisión de balance<br><br>
        Documento generado automáticamente.<br>
        Diagramas fuente: <code>docs/manual/diagrams/*.mmd</code> (tema Mermaid <em>neo</em>).<br><br>
        <?php echo e($generadoEn->format('d/m/Y H:i')); ?> · MVP Laravel / MySQL / Podman
    </section>

    <?php echo $__env->make('pdf.partials.numeracion-paginas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/pdf/manual-proyecto.blade.php ENDPATH**/ ?>