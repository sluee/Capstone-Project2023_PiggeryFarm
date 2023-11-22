<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Head, Link, useForm,  } from '@inertiajs/vue3';
import { onMounted} from 'vue'

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    flash: {
        type: Object,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
onMounted(() => {
    // Set a timeout to hide the success flash message after 3 seconds
        const successFlashMessage = document.getElementById('flash-success-message');
            if (successFlashMessage) {
                setTimeout(() => {
                successFlashMessage.style.display = 'none';
                }, 3000);
        }

        // Set a timeout to hide the error flash message after 3 seconds
        const errorFlashMessage = document.getElementById('flash-error-message');
            if (errorFlashMessage) {
                setTimeout(() => {
                errorFlashMessage.style.display = 'none';
            }, 3000);
        }
    });

</script>

<style scoped>

#flash-success-message {
    animation: fadeOut 7s ease-in-out forwards;
}

.progress-bar {
    height: 5px;
    width: 100%;
    background-color: #4CAF50; /* Green color */
    animation: progressBar 3s linear;
}
#flash-error-message {
    animation: fadeOut 6s ease-in-out forwards;
}

.success .progress-bar {
   
    animation: progressBar 5s linear;
}
.error .progress-bar {
    background-color: #FF5733; /* Red color */
    animation: progressBar 5s linear;
}

@keyframes fadeOut {
    from {
        opacity: 1;
    }
    to {
        opacity: 0;
    }
}

@keyframes progressBar {
    0% {
        width: 100%;
    }
    100% {
        width: 0;
    }
}

</style>


<template>
    <GuestLayout>
        <Head title="Log in" />
        
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <div v-if="$page.props.flash.success" id="flash-success-message" class="absolute top-20 right-1 p-4 bg-green-300 border border-gray-300 rounded-md shadow-md">
            {{ $page.props.flash.success }}
            <div class="progress-bar success"></div>
        </div>

        <div v-if="$page.props.flash.error" id="flash-error-message" class=" absolute top-20 right-1 p-4 bg-red-300 border border-gray-300 rounded-md shadow-md">
            {{ $page.props.flash.error }}
            <div class="progress-bar error"></div>
        </div>
        <template #logo>
            <!-- <div v-if="$page.props.flash.error"></div> -->
            <img src="/images/picc.jpg" alt="" class="object-cover w-full rounded-l-xl opacity-80">

            <div class="bg-gray-700 opacity-20 absolute top-0 h-full w-full"></div>

            <!-- <div class="absolute top-0 flex-col w-full pt-36">
                <img src="images/mdc.png" alt="mdc-logo" class="w-32 h-32 mx-auto mb-3">
                <h1 class="text-4xl font-extrabold text-white text-center" style="font-family: 'Poppins', sans-serif;">Mater Dei College's <br> Clinic Management <br> System</h1>
            </div> -->
        </template>

        <template #form>
            <div class="px-10 py-5">

                <h1 class="text-2xl font-extrabold text-gray-700 text-center mb-2">RQR Piggery Farm</h1>
                <hr>

                <h4 class="text-lg font-light text-gray-700 text-center mb-3">Log in</h4>
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="email" value="Email" />
                        <TextInput
                            id="email"
                            v-model="form.email"
                            type="email"
                            class="mt-1 block w-full"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password" value="Password" />
                        <TextInput
                            id="password"
                            v-model="form.password"
                            type="password"
                            class="mt-1 block w-full"
                            required
                            autocomplete="current-password"
                        />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <!-- <div class="block mt-4">
                        <label class="flex items-center">
                            <Checkbox v-model:checked="form.remember" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                    </div> -->

                    <div class="flex justify-end mt-4">
                        <!-- <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Forgot your password?
                        </Link> -->

                        <PrimaryButton class="w-1/4 justify-center px-6 ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            <span class="text-white">Login</span>
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </template>

        <!-- component -->

    </GuestLayout>
</template>
