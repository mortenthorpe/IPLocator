<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerXxiIxnb\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerXxiIxnb/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerXxiIxnb.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerXxiIxnb\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerXxiIxnb\App_KernelDevDebugContainer([
    'container.build_hash' => 'XxiIxnb',
    'container.build_id' => '44344b07',
    'container.build_time' => 1595234902,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerXxiIxnb');