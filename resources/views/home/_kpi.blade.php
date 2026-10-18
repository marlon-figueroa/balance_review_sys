@props([
    'label',
    'value',
    'valueClass' => '',
    'emphasis' => null,
])

<div {{ $attributes->class([
    'dashboard-kpi',
    'dashboard-kpi--'.$emphasis => $emphasis,
]) }}>
    <div class="dashboard-kpi__label">{{ $label }}</div>
    <div @class(['dashboard-kpi__value', 'fw-bold', $valueClass])>{{ $value }}</div>
</div>
