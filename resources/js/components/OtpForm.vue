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

const { user } = defineProps<{ user: UserProps }>();

const value = ref<string[]>([]);
const handleComplete = (e: string[]) => {
    const otp: number = parseInt(e.join(""));

    const updatedUser = { ...user, otp };

    router.post("/register", updatedUser);
};
</script>

<template>
    <div>
        <PinInput
            type="number"
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
