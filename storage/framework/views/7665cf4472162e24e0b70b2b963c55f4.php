<?php $__env->startSection('title', 'Mi perfil'); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $iniciales = collect(explode(' ', $usuario->name))
            ->filter()
            ->take(2)
            ->map(fn (string $p) => mb_strtoupper(mb_substr($p, 0, 1)))
            ->implode('');
    ?>

    <div class="perfil-page">
        <article class="card perfil-hero border-0 shadow-sm rounded-4 overflow-hidden mb-3">
            <div class="perfil-hero__cover" aria-hidden="true"></div>
            <div class="card-body perfil-hero__body px-4 px-lg-5 pb-4 pb-lg-5 pt-0">
                <div class="row g-4 align-items-end">
                    <div class="col-auto">
                        <div class="perfil-avatar-wrap">
                            <img src="<?php echo e($usuario->photoUrl()); ?>" alt="" class="perfil-avatar rounded-circle object-fit-cover" width="128" height="128">
                        </div>
                    </div>
                    <div class="col min-w-0">
                        <p class="text-uppercase small fw-semibold text-primary mb-1 letter-spacing">Mi perfil</p>
                        <h1 class="h3 mb-1 fw-bold text-truncate"><?php echo e($usuario->name); ?></h1>
                        <p class="text-body-secondary mb-2">
                            <i class="bi bi-envelope me-1"></i><?php echo e($usuario->email); ?>

                        </p>
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $usuario->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <span class="badge rounded-pill text-bg-primary-subtle text-primary-emphasis border border-primary-subtle">
                                    <i class="bi bi-shield-check me-1"></i><?php echo e($rol->name); ?>

                                </span>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <span class="badge text-bg-secondary">Sin rol asignado</span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <span class="small text-body-secondary">
                                <i class="bi bi-calendar3 me-1"></i>Miembro desde <?php echo e($usuario->created_at?->translatedFormat('F Y')); ?>

                            </span>
                        </div>
                    </div>
                </div>

                <p class="small text-body-secondary border-top pt-3 mt-4 mb-0">
                    <i class="bi bi-info-circle me-1"></i>
                    Los roles los administra un administrador. Aquí puedes actualizar tu información personal, foto y contraseña.
                </p>

                <div class="row g-3 mt-3">
                    <div class="col-6 col-lg-3">
                        <div class="perfil-stat rounded-3 h-100">
                            <div class="perfil-stat__value"><?php echo e($estadisticas['periodos_creados']); ?></div>
                            <div class="perfil-stat__label">Periodos creados</div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="perfil-stat rounded-3 h-100">
                            <div class="perfil-stat__value"><?php echo e($estadisticas['periodos_abiertos']); ?></div>
                            <div class="perfil-stat__label">Abiertos</div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="perfil-stat rounded-3 h-100">
                            <div class="perfil-stat__value"><?php echo e($estadisticas['periodos_certificados']); ?></div>
                            <div class="perfil-stat__label">Certificados</div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="perfil-stat rounded-3 h-100">
                            <div class="perfil-stat__value"><?php echo e($estadisticas['hallazgos_periodos']); ?></div>
                            <div class="perfil-stat__label">Hallazgos</div>
                        </div>
                    </div>
                </div>
            </div>
        </article>

        <nav class="nav nav-pills perfil-subnav gap-2 mb-4 flex-nowrap overflow-auto pb-1" aria-label="Secciones del perfil">
            <a class="nav-link active" href="#informacion"><i class="bi bi-person me-1"></i> Información</a>
            <a class="nav-link" href="#seguridad"><i class="bi bi-key me-1"></i> Seguridad</a>
            <a class="nav-link" href="#revisiones"><i class="bi bi-journal-check me-1"></i> Revisiones</a>
        </nav>

        <div class="row g-4">
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4" id="informacion">
                    <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
                        <h2 class="h5 mb-0">Información personal</h2>
                        <p class="small text-body-secondary mb-0 mt-1">Nombre, correo y foto visible en el sistema.</p>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="<?php echo e(route('perfil.update')); ?>" enctype="multipart/form-data" autocomplete="off">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="mb-3 position-relative">
                                <label id="photo-label" class="form-label">Foto de perfil</label>
                                <div id="photo-dropzone"
                                     class="dropzone photo-dropzone <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                     aria-labelledby="photo-label"
                                     data-existing-photo="<?php echo e($usuario->photoUrl()); ?>"></div>
                                <input type="file" id="photo" name="photo" class="photo-dropzone-input" tabindex="-1"
                                       accept="image/jpeg,image/png,image/webp,image/gif" aria-labelledby="photo-label">
                                <div class="form-text">JPG, PNG, WEBP o GIF. Máximo 2 MB.</div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback d-block"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" value="<?php echo e(old('name', $usuario->name)); ?>"
                                       class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label">Correo electrónico <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" value="<?php echo e(old('email', $usuario->email)); ?>"
                                       class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-check2-circle me-1"></i> Guardar cambios
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 mt-4" id="seguridad">
                    <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
                        <h2 class="h5 mb-0">Seguridad</h2>
                        <p class="small text-body-secondary mb-0 mt-1">Actualice su contraseña de acceso.</p>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="<?php echo e(route('perfil.password')); ?>" autocomplete="off">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Contraseña actual <span class="text-danger">*</span></label>
                                <input type="password" id="current_password" name="current_password" autocomplete="current-password"
                                       class="form-control <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Nueva contraseña <span class="text-danger">*</span></label>
                                <input type="password" id="password" name="password" autocomplete="new-password"
                                       class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <div class="form-text">Mínimo 8 caracteres.</div>
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirmar nueva contraseña</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-outline-primary w-100">
                                <i class="bi bi-shield-lock me-1"></i> Cambiar contraseña
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4" id="revisiones">
                    <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
                        <h2 class="h5 mb-0">Mis revisiones de balance</h2>
                        <span class="badge text-bg-primary rounded-pill"><?php echo e($periodos->count()); ?></span>
                    </div>
                    <div class="card-body p-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($periodos->isEmpty()): ?>
                            <?php echo $__env->make('perfil.partials.vacio', [
                                'icon' => 'journal-check',
                                'titulo' => 'Sin periodos',
                                'texto' => 'Cuando cree revisiones de balance aparecerán aquí.',
                            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php else: ?>
                            <ul class="list-group list-group-flush">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $periodos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $periodo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                        <a href="<?php echo e(route('revisiones.show', $periodo)); ?>" class="text-decoration-none"><?php echo e($periodo->etiquetaPeriodo()); ?></a>
                                        <span class="badge text-bg-light border"><?php echo e($periodo->estado->etiqueta()); ?></span>
                                    </li>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </ul>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('revisiones.ver')): ?>
                        <div class="card-footer bg-transparent border-0 px-4 pb-4">
                            <a href="<?php echo e(route('revisiones.index')); ?>" class="btn btn-sm btn-outline-primary">Ver listado</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/pages/usuario-form.js'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/pages/perfil.js'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mfigueroa93/Documents/git/balance_review_sys/resources/views/perfil/show.blade.php ENDPATH**/ ?>