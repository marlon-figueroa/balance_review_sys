@props(['svg' => null, 'titulo', 'leyenda' => null])

<figure class="diagrama-manual">
    <figcaption class="diagrama-manual__titulo">{{ $titulo }}</figcaption>
    @if ($svg)
        <div class="diagrama-manual__svg">{!! $svg !!}</div>
    @else
        <p class="diagrama-manual__faltante">Diagrama no generado. Ejecute <code>npm run docs:diagrams</code>.</p>
    @endif
    @if ($leyenda)
        <p class="diagrama-manual__leyenda">{{ $leyenda }}</p>
    @endif
</figure>
