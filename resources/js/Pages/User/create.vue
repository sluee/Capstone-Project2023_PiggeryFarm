<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { ref } from 'vue';
    import { Link , Head, usePage} from '@inertiajs/vue3';
    import { useForm } from '@inertiajs/vue3';
    // import Multiselect from 'vue-multiselect'
    // const { data } = usePage().props;
    let form = useForm({
        lastName: '',
        firstName:'',
        middleName: '',
        suffix: '',
        email:'',
        password:'',
        password_confirmation:'',
        status:'',
        gender:'',
        type: '',
        role: '',
        pos_id: '',
        address:'',
        phone: '',

    })

    let props = defineProps({
        roles:Array,
        employee:Object,
        positions: Object

    })

    function toggleFields(){
        if (form.type !== 'employee') {
        form.position = '';

      }
    }

    const submit = () =>{
        form.post('/users')
        console.log(form);
    }

</script>

<template>
    <Head title="Create User"/>
    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create User</h2>
        </template>
        <div>
            <div class="w-full mt-10 mx-auto px-4 ">
                <form @submit.prevent="submit">
                    <div class="space-y-6">
                        <div class="block pl-12 font-semibold text-xl self-start text-gray-700">
                            <h1 class="leading-relaxed">User Details Form</h1>
                            <hr>
                          </div>
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
                            <label for="roles" class="block text-sm font-medium leading-6 text-gray-900">Roles</label>
                            <div class="mt-2">
                              <select id="role" v-model="form.role" name="role" autocomplete="role" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option selected disabled   >Select Role</option>
                                <option v-for="role in roles" :key="role.id" :value="role.name">{{ role.name }}</option>
                                <!-- <option value="Role">Patient</option> -->
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
                            <label for="type" class="block text-sm font-medium leading-6 text-gray-900">Position</label>
                            <div class="mt-2">
                              <select id="pos_id" v-model="form.pos_id" name="position"  autocomplete="position" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
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
