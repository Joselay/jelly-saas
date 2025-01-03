<script lang="ts" setup>
import type { HTMLAttributes } from "vue";
import { cn } from "@/lib/utils";
import { Primitive, type PrimitiveProps } from "radix-vue";
import { Link } from "@inertiajs/vue3";

const props = withDefaults(
    defineProps<PrimitiveProps & { class?: HTMLAttributes["class"] }>(),
    {
        as: Link,
    }
);
</script>

<template>
    <Primitive
        :as="as"
        :as-child="asChild"
        :class="cn('transition-colors hover:text-foreground', props.class)"
    >
        <slot />
    </Primitive>
</template>
