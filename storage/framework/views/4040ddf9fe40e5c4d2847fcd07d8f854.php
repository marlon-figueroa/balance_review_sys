<?php $__env->startSection('title', 'Inicio'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => __('Dashboard'),'icon' => 'speedometer2','subtitle' => now()->translatedFormat('l \d\e F \d\e Y'),'section' => null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Dashboard')),'icon' => 'speedometer2','subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(now()->translatedFormat('l \d\e F \d\e Y')),'section' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(null)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $attributes = $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $component = $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>

    <div class="dashboard-compact">
        <p class="mb-3 small text-body-secondary">
            Bienvenido(a), <strong class="text-body-emphasis"><?php echo e(Auth::user()->name); ?></strong>.
        </p>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('revisiones.ver')): ?>
            <section class="dashboard-section mb-4" aria-labelledby="dashboard-revisiones-titulo">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2">
                    <h2 class="dashboard-section__title mb-0" id="dashboard-revisiones-titulo">
                        <i class="bi bi-journal-check me-1" aria-hidden="true"></i>
                        Revisión de balance
                    </h2>
                    <a href="<?php echo e(route('revisiones.index')); ?>" class="small text-decoration-none">
                        Ver periodos <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="card">
                    <div class="card-body py-3">
                        <div class="row g-2 row-cols-2 row-cols-md-4">
                            <?php echo $__env->make('home._kpi', ['label' => 'Abiertos', 'value' => $revisiones['periodos_abiertos']], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php echo $__env->make('home._kpi', ['label' => 'En revisión', 'value' => $revisiones['en_revision'], 'valueClass' => 'text-warning'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php echo $__env->make('home._kpi', ['label' => 'Hallazgos críticos', 'value' => $revisiones['hallazgos_criticos'], 'valueClass' => 'text-danger'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php echo $__env->make('home._kpi', [
                                'label' => 'Último certificado',
                                'value' => $revisiones['ultimo_certificado']?->etiquetaPeriodo() ?? '—',
                            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! empty($revisiones['kpis_ultimo'])): ?>
                            <hr class="my-3">
                            <p class="small text-body-secondary mb-2">KPIs del último periodo certificado</p>
                            <div class="row g-2 small">
                                <div class="col-md-4">Liquidez: <strong><?php echo e($revisiones['kpis_ultimo']['liquidez_corriente'] ?? '—'); ?></strong></div>
                                <div class="col-md-4">Endeudamiento: <strong><?php echo e($revisiones['kpis_ultimo']['endeudamiento'] ?? '—'); ?></strong></div>
                                <div class="col-md-4">Capital de trabajo: <strong><?php echo e(number_format($revisiones['kpis_ultimo']['capital_trabajo'] ?? 0, 2)); ?></strong></div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($statsAdmin) > 0): ?>
            <section class="dashboard-section" aria-labelledby="dashboard-admin-titulo">
                <h2 class="dashboard-section__title mb-2" id="dashboard-admin-titulo">
                    <i class="bi bi-gear me-1"></i> Administración
                </h2>
                <div class="row g-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $statsAdmin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="col-md-4">
                            <a href="<?php echo e($stat['route']); ?>" class="text-decoration-none">
                                <div class="card h-100 border-<?php echo e($stat['color']); ?>">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <i class="bi bi-<?php echo e($stat['icon']); ?> fs-3 text-<?php echo e($stat['color']); ?>"></i>
                                        <div>
                                            <div class="small text-body-secondary"><?php echo e($stat['label']); ?></div>
                                            <div class="fs-4 fw-semibold"><?php echo e($stat['total']); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/home.blade.php ENDPATH**/ ?>