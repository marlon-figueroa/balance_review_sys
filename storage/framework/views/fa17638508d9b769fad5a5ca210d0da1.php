
<script type="text/php">
if (isset($pdf)) {
    $font = $fontMetrics->getFont('DejaVu Sans');
    $size = 9;
    $color = [0.42, 0.45, 0.49];
    $ancho = $pdf->get_width();
    $alto = $pdf->get_height();
    $pdf->page_text($ancho - 95, $alto - 28, 'Página {PAGE_NUM}/{PAGE_COUNT}', $font, $size, $color);
}
</script>
<?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/pdf/partials/numeracion-paginas.blade.php ENDPATH**/ ?>