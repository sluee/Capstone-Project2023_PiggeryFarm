<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { onMounted, ref, watch } from 'vue';
    import { Link , Head, usePage} from '@inertiajs/vue3';
    import { useForm } from '@inertiajs/vue3';

    let props = defineProps({
        roles:Object,
        user:Object,
        employee:Object,
        positions: Object,
        currentRole:String

    })
    let form = useForm({
        lastName: props.user.lastName,
        firstName:props.user.firstName,
        middleName: props.user.middleName,
        suffix: props.user.suffix,
        email:props.user.email,
        password:props.user.password,
        status:props.user.status,
        gender:props.user.gender,
        type: props.user.type,
        role: props.user.roles.map((role) => role.name),
        address:props.user.address,
        phone: props.user.phone,
        pos_id: props.user.employee ? props.user.employee.position.id : null,

    })

    const localStorageKeyToggle = `toggleState_${props.user.id}`;

    onMounted(() => {
        const savedToggleState = JSON.parse(localStorage.getItem(localStorageKeyToggle));
        if (savedToggleState !== null) {
            isActive.value = savedToggleState;
        }

    });

    const isActive = ref(props.user.status === 1);

    const toggleActive = () => {
        isActive.value = !isActive.value;
        form.status = isActive.value ? 1 : 0;

        localStorage.setItem(localStorageKeyToggle, JSON.stringify(isActive.value));
    };

    function toggleFields(){
        if (form.type === 'employee') {
        form.pos_id = props.user.employee.position.position;
      }
    }
    onMounted(() => {
        const selectRole = document.getElementById('select-role');

    if (selectRole) {
        new TomSelect(selectRole, {
        maxItems: 3,
        });
    }
    });

    const submit = () =>{
        form.put('/users/'+props.user.id)
    }
</script>

<template>
    <Head title="Edit User"/>
    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit User</h2>
        </template>
        <div>
            <div class="w-full mt-10 mx-auto px-4 ">
                <form @submit.prevent="submit">
                    <div class="space-y-6">
                        <div class="pl-12 font-semibold text-xl self-start text-gray-700 flex -mb-4">
                            <h1 class="leading-relaxed flex-1">Employee Details Form</h1>

                            <div class="flex items-center mr-6">
                                <h1 class="text-sm mr-2">Active status:</h1>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" v-model="isActive" class="peer hidden" @change="toggleActive">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600" @click="toggleActive"></div>
                                    <span class="ml-6 text-md font-semibold text-gray-900 dark:text-gray-300"></span>
                                </label>
                            </div>
                        </div><hr>
                      <div class="border-b border-gray-900/10 pb-12">

                        <div class=" px-12 py-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-3 mx-auto">
                          <div class="sm:col-span-1">
                            <label for="firstName" class="block text-sm font-medium leading-6 text-gray-900">First name</label>
                            <div class="mt-2">
                              <input type="text" v-model="form.firstName" name="firstName" id="firstName" autocomplete="firstName" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                              <div class="text-sm text-red-500 italic" v-if="form.errors.firstName">{{ form.errors.firstName }}</div>
                            </div>
                          </div>
                          <div class="sm:col-span-1">
                            <label for="middleName" class="block text-sm font-medium leading-6 text-gray-900">Middle name</label>
                            <div class="mt-2">
                              <input type="text" v-model="form.middleName" name="middleName" id="middleName" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                              <div class="text-sm text-red-500 italic" v-if="form.errors.middleName">{{ form.errors.middleName }}</div>
                            </div>
                          </div>
                          <div class="sm:col-span-1">
                            <label for="lastName" class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
                            <div class="mt-2">
                              <input type="text" v-model="form.lastName" name="lastName" id="lastName" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                              <div class="text-sm text-red-500 italic" v-if="form.errors.lastName">{{ form.errors.lastName }}</div>
                            </div>
                          </div>

                          <div class="sm:col-span-1">
                            <label for="suffix" class="block text-sm font-medium leading-6 text-gray-900">Suffix</label>
                            <div class="mt-2">
                              <input id="suffix" v-model="form.suffix" name="suffix" type="text" autocomplete="suffix" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                              <div class="text-sm text-red-500 italic" v-if="form.errors.suffix">{{ form.errors.suffix }}</div>
                            </div>
                          </div>

                          <div class="m:col-span-1">
                            <label for="gender" class="block text-sm font-medium leading-6 text-gray-900">Gender</label>
                            <div class="mt-2">
                              <select id="gender" v-model="form.gender" name="gender" autocomplete="gender" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option selected disabled>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              </select>
                              <div class="text-sm text-red-500 italic" v-if="form.errors.gender">{{ form.errors.gender }}</div>
                            </div>
                          </div>


                          <div class="m:col-span-1">
                            <!-- <p>Current Role: {{ user.roles.map(role => role.name).join(', ') }}</p> -->
                            <label for="roles" class="block text-sm font-medium leading-6 text-gray-900">Roles</label>

                              <div class="mt-2">

                                  <select
                                      id="select-role"
                                      name="role[]"
                                      multiple
                                      placeholder="Select roles..."
                                      autocomplete="off"
                                      v-model="form.role"
                                      class="block w-full rounded-sm cursor-pointer focus:outline-none"

                                      >
                                      <option selected disabled>Select role</option>
                                      <option  v-for="role in roles" :key="role.id" :value="role.name">{{ role.name }}</option>

                                  </select>

                              <div class="text-sm text-red-500 italic" v-if="form.errors.role">{{ form.errors.role }}</div>
                            </div>
                          </div>


                          <div class="sm:col-span-2">
                            <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Contact No</label>
                            <div class="mt-2">
                              <input id="phone" v-model="form.phone" name="phone" type="number" autocomplete="phone" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                              <div class="text-sm text-red-500 italic" v-if="form.errors.phone">{{ form.errors.phone }}</div>
                            </div>
                          </div>

                          <div class="m:col-span-1">
                            <label for="type" class="block text-sm font-medium leading-6 text-gray-900">Type</label>
                            <div class="mt-2">
                              <select id="type" v-model="form.type" name="type" @change="toggleFields" autocomplete="type" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option selected disabled>Select Type</option>
                                <option value="owner">Owner</option>
                                <option value="employee">Employee</option>
                                <option value="admin">Admin</option>
                              </select>
                              <div class="text-sm text-red-500 italic" v-if="form.errors.type">{{ form.errors.type }}</div>
                            </div>
                          </div>
                          <div class="m:col-span-1" v-if="form.type === 'employee'">
                            <!-- <p>Current Position: {{ user.employee.position.position}}</p>  -->
                            <label for="type" class="block text-sm font-medium leading-6 text-gray-900">Position</label>
                            <div class="mt-2">
                              <select id="pos_id" v-model="form.pos_id" name="position" autocomplete="position" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option selected disabled>Select position</option>
                                <option v-for="position in positions" :key="position.id" :value="position.id">{{ position.position }}</option>
                              </select>
                              <div class="text-sm text-red-500 italic" v-if="form.errors.pos_id">{{ form.errors.pos_id }}</div>
                            </div>
                          </div>

                          <div class="sm:col-span-1">
                            <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Address</label>
                            <div class="mt-2">
                              <input id="address" v-model="form.address" name="address" type="text" autocomplete="address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                              <div class="text-sm text-red-500 italic" v-if="form.errors.address">{{ form.errors.address }}</div>
                            </div>
                          </div>

                          <div class="sm:col-span-1">
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                            <div class="mt-2">
                              <input id="email" v-model="form.email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                              <div class="text-sm text-red-500 italic" v-if="form.errors.email">{{ form.errors.email }}</div>
                            </div>
                          </div>

                          <div class="sm:col-span-1 ">
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                            <div class="mt-2">
                              <input type="password" v-model="form.password" name="password" id="password"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                              <div class="text-sm text-red-500 italic" v-if="form.errors.password">{{ form.errors.password }}</div>
                            </div>
                          </div>


                          <div class="sm:col-span-1">
                            <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirm Password</label>
                            <div class="mt-2">
                              <input type="password" v-model="form.password_confirmation" name="password_confirmation" id="password_confirmation" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                              <div class="text-sm text-red-500 italic" v-if="form.errors.gender">{{ form.errors.password_confirmation }}</div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6 mb-3">
                      <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                      <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                    </div>
                  </form>
            </div>
        </div>
    </SideBarLayout>

</template>
