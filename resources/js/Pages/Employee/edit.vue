<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { ref, watch } from 'vue';
    import { Link , Head} from '@inertiajs/vue3';
    import { useForm } from '@inertiajs/vue3';
    import { onMounted } from 'vue';

    let props = defineProps({
        employee: Object,
        position: Object,
        user: Object,
        roles:Object
    })

    let form = useForm({
        // doc_id: '',
        lastName: props.employee.user.lastName,
        firstName:props.employee.user.firstName,
        middleName:props.employee.user.middleName,
        suffix: props.employee.user.suffix,
        email:props.employee.user.email,
        address:props.employee.user.address,
        role: props.employee.user.roles.map((role) => role.name),
        password:'',
        password_confirmation:'',
        status:props.employee.status,
        gender:props.employee.user.gender,
        pos_id: props.employee.pos_id,
        phone: props.employee.user.phone,
       
    })


    const localStorageKeyToggle = `toggleState_${props.employee.id}`;

    onMounted(() => {
        const savedToggleState = JSON.parse(localStorage.getItem(localStorageKeyToggle));
        if (savedToggleState !== null) {
            isActive.value = savedToggleState;
        }

        const savedScrollPosition = localStorage.getItem('scrollPosition');
        if (savedScrollPosition !== null) {
            window.scrollTo(0, savedScrollPosition);
        }
    });

    const isActive = ref(props.employee.status === 1);

    const toggleActive = () => {
        isActive.value = !isActive.value;
        form.status = isActive.value ? 1 : 0;

        localStorage.setItem(localStorageKeyToggle, JSON.stringify(isActive.value));
    };

    onMounted(() => {
        const selectRole = document.getElementById('select-role');

    if (selectRole) {
        new TomSelect(selectRole, {
        maxItems: 3,
        });
    }
    });

    const submit = () =>{
        let roleName = form.role === 'Employee' ? 'employee' : 'specialEmployee';

        form.put(`/employees/${props.employee.id}`, {
            role: roleName,
        });
    }
</script>

<template>
    <Head title="Edit Employee"/>
    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Employee</h2>
        </template>
        <div>
            <div class="w-full mt-10 mx-auto px-4 ">
                <form @submit.prevent="submit">
                    <div class="space-y-6">
                        <div class="pl-12 font-semibold text-xl self-start text-gray-700 flex -mb-4">
                            <h1 class="leading-relaxed flex-1">Employee Details Form</h1>

                            <div class="flex items-center mr-6">
                                <h1 class="text-sm mr-2">Active status:</h1>
                                <label class="relative inline-flex items-center cursor-pointer" :for="'status-' + employee.id">
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
                              <input type="text" v-model="form.middleName" name="middleName" id="middleName" autocomplete="middleName" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                              <div class="text-sm text-red-500 italic" v-if="form.errors.middleName">{{ form.errors.middleName }}</div>
                            </div>
                          </div>

                          <div class="sm:col-span-1">
                            <label for="lastName" class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
                            <div class="mt-2">
                              <input type="text" v-model="form.lastName" name="lastName" id="lastName" autocomplete="lastName" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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

                          <div class="sm:col-span-1">
                            <label for="gender" class="block text-sm font-medium leading-6 text-gray-900">Gender</label>
                            <div class="mt-2">
                              <select id="gender" v-model="form.gender" name="gender" autocomplete="gender" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option selected disabled   >Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              </select>
                              <div class="text-sm text-red-500 italic" v-if="form.errors.gender">{{ form.errors.gender }}</div>
                            </div>
                          </div>

                          <div class="m:col-span-2">
                            <label for="pos_id" class="block text-sm font-medium leading-6 text-gray-900">Position</label>
                            <div class="mt-2">
                                <select id="pos_id" v-model="form.pos_id" name="services" autocomplete="services"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" >
                                  <option selected disabled >Select Position</option>
                                  <option v-for="pos in position" :key="pos.id" :value="pos.id">{{ pos.position }}</option>
                                </select>
                                <div class="text-sm text-red-500 italic" v-if="form.errors.pos_id">{{ form.errors.pos_id }}</div>
                              </div>
                          </div>

                          <div class="sm:col-span-1 ">
                            <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Contact No</label>
                            <div class="mt-2">
                              <input id="phone" v-model="form.phone" name="phone" type="number" autocomplete="phone" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                              <div class="text-sm text-red-500 italic" v-if="form.errors.phone">{{ form.errors.phone }}</div>
                            </div>
                          </div>
                          <div class="sm:col-span-1 ">
                            <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Address</label>
                            <div class="mt-2">
                              <input id="address" v-model="form.address" name="address" type="text" autocomplete="address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                              <div class="text-sm text-red-500 italic" v-if="form.errors.address">{{ form.errors.address }}</div>
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

                          <div class="sm:col-span-1 sm:col-start-1">
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                            <div class="mt-2">
                              <input id="email" v-model="form.email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                              <div class="text-sm text-red-500 italic" v-if="form.errors.gender">{{ form.errors.gender }}</div>
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
                              <div class="text-sm text-red-500 italic" v-if="form.errors.password_confirmation">{{ form.errors.password_confirmation }}</div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6 mb-3">
                      <a href="/employees"><button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button></a>
                      <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                    </div>
                  </form>
            </div>
        </div>
    </SideBarLayout>

</template>
