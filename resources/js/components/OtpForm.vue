<script setup lang="ts">
import {
    PinInput,
    PinInputGroup,
    PinInputInput,
    PinInputSeparator,
} from "@/components/ui/pin-input";
import { UserProps } from "@/interface/user";
import { router } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps<{ user: UserProps }>();

const value = ref<string[]>([]);
const handleComplete = (e: string[]) => {
    const otp: string = e.join("");
    router.post("/register");
};
</script>

<template>
    <div>
        <PinInput
            id="pin-input"
            v-model="value"
            placeholder="○"
            @complete="handleComplete"
        >
            <PinInputGroup>
                <template v-for="(id, index) in 6" :key="id">
                    <PinInputInput class="border rounded-md" :index="index" />
                    <template v-if="index !== 5">
                        <PinInputSeparator />
                    </template>
                </template>
            </PinInputGroup>
        </PinInput>
    </div>
</template>
