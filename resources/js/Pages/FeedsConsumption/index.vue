<template>

    <Head title="Feeds Consumption" />

    <SideBarLayout>
        <template #header >
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">List of Feeds Consumptions</h2>
                <div style="position:relative">
                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-9 p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Feeds Purchase here" v-model="search">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#444  " width="20px" height="20px" viewBox="0 0 16 16"
                    style="position:absolute; top:10px; right:10px">
                    <path d="M12.027 9.92L16 13.95 14 16l-4.075-3.976A6.465 6.465 0 0 1 6.5 13C2.91 13 0 10.083 0 6.5 0 2.91 2.917 0 6.5 0 10.09 0 13 2.917 13 6.5a6.463 6.463 0 0 1-.973 3.42zM1.997 6.452c0 2.48 2.014 4.5 4.5 4.5 2.48 0 4.5-2.015 4.5-4.5 0-2.48-2.015-4.5-4.5-4.5-2.48 0-4.5 2.014-4.5 4.5z" fill-rule="evenodd"/>
                    </svg>
                </div>
                <div class="flex">
                    <button
                        type="button"
                        class="button1 mb-2 py-2 px-3 bg-blue-300 shadow border-gray-300 border hover:bg-blue-400 rounded mr-3"
                        @click="openAddItemModal"
                    >
                    Add Consumption </button>
                    <a :href="route('consumption.pdf')" class="flex  mb-2 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded mr-3 " target="blank">
                        <svg viewBox="0 0 512 512" version="1.1" height="20px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#6666"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>pdf-document</title> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="add" fill="#000000" transform="translate(85.333333, 42.666667)"> <path d="M75.9466667,285.653333 C63.8764997,278.292415 49.6246897,275.351565 35.6266667,277.333333 L1.42108547e-14,277.333333 L1.42108547e-14,405.333333 L28.3733333,405.333333 L28.3733333,356.48 L40.5333333,356.48 C53.1304778,357.774244 65.7885986,354.68506 76.3733333,347.733333 C85.3576891,340.027178 90.3112817,328.626053 89.8133333,316.8 C90.4784904,304.790173 85.3164923,293.195531 75.9466667,285.653333 L75.9466667,285.653333 Z M53.12,332.373333 C47.7608867,334.732281 41.8687051,335.616108 36.0533333,334.933333 L27.7333333,334.933333 L27.7333333,298.666667 L36.0533333,298.666667 C42.094796,298.02451 48.1897668,299.213772 53.5466667,302.08 C58.5355805,305.554646 61.3626692,311.370371 61.0133333,317.44 C61.6596233,323.558965 58.5400493,329.460862 53.12,332.373333 L53.12,332.373333 Z M150.826667,277.333333 L115.413333,277.333333 L115.413333,405.333333 L149.333333,405.333333 C166.620091,407.02483 184.027709,403.691457 199.466667,395.733333 C216.454713,383.072462 225.530463,362.408923 223.36,341.333333 C224.631644,323.277677 218.198313,305.527884 205.653333,292.48 C190.157107,280.265923 170.395302,274.806436 150.826667,277.333333 L150.826667,277.333333 Z M178.986667,376.32 C170.098963,381.315719 159.922142,383.54422 149.76,382.72 L144.213333,382.72 L144.213333,299.946667 L149.333333,299.946667 C167.253333,299.946667 174.293333,301.653333 181.333333,308.053333 C189.877212,316.948755 194.28973,329.025119 193.493333,341.333333 C194.590843,354.653818 189.18793,367.684372 178.986667,376.32 L178.986667,376.32 Z M254.506667,405.333333 L283.306667,405.333333 L283.306667,351.786667 L341.333333,351.786667 L341.333333,329.173333 L283.306667,329.173333 L283.306667,299.946667 L341.333333,299.946667 L341.333333,277.333333 L254.506667,277.333333 L254.506667,405.333333 L254.506667,405.333333 Z M234.666667,7.10542736e-15 L9.52127266e-13,7.10542736e-15 L9.52127266e-13,234.666667 L42.6666667,234.666667 L42.6666667,192 L42.6666667,169.6 L42.6666667,42.6666667 L216.96,42.6666667 L298.666667,124.373333 L298.666667,169.6 L298.666667,192 L298.666667,234.666667 L341.333333,234.666667 L341.333333,106.666667 L234.666667,7.10542736e-15 L234.666667,7.10542736e-15 Z" id="document-pdf"> </path> </g> </g> </g></svg>
                            Export Consumption
                    </a>
                </div>
            </div>
            <div v-if="$page.props.flash.success" id="flash-success-message" class="absolute top-20 right-1 p-4 bg-green-300 border border-gray-300 rounded-md shadow-md">
                {{ $page.props.flash.success }}
                <div class="progress-bar success"></div>
            </div>

            <div v-if="$page.props.flash.error" id="flash-error-message" class=" absolute top-20 right-1 p-4 bg-red-300 border border-gray-300 rounded-md shadow-md">
                {{ $page.props.flash.error }}
                <div class="progress-bar error"></div>
            </div>
        </template>
        <div class="py-12">              
            <div >
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-7">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <!-- <div class="p-6 text-gray-900">You're logged in!</div> -->
                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Id</th>
                                    <th class="py-3 px-6 text-left">Date</th>
                                    <th class="py-3 px-6 text-left">Feeds</th>
                                    <th class="py-3 px-6 text-left">Quantity</th>
                                 
                                    <th class="py-3 px-6 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light" >
                                <tr v-if="consumption.data.length === 0">
                                    <td colspan="10" class="text-center text-lg  text-gray-400 py-6">No feeds consumption record available</td>
                                </tr>
                                <tr  class="border-b border-gray-200 hover:bg-gray-100" v-for="cons in consumption.data" :key="cons.id">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">
    
                                            <p class="font-medium">{{ cons.id }}</p>
                                        </div>
                                    </td>
    
                                    <td class="py-3 px-5 text-left whitespace-nowrap">
                                        <div class="text-sm">
                                            <div class="font-medium ">{{formattedDate(cons.date) }}</div>
    
                                        </div>
                                    </td>
                                    
                                    <td class="py-3 px-5 text-left whitespace-nowrap">
                                        <div class="text-sm">
                                            <div class="font-medium ">{{ cons.feeds.categories.name }}</div>
                                            <div class="">{{ cons.feeds.supplier.name }}</div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">
    
                                            <p class="font-medium">{{ cons.qty }} bags</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-5 text-center">
                                        <div class="flex item-center justify-center">
                                            <!-- <div class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                                <button class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#6666" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </button>
                                                
                                            </div> -->
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <a href="#" @click="edit(cons)" class="btn" title="Edit purchase">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>
                                            </div>
                                            
                                            <!-- <div class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </div> -->
                                        </div>
                                    </td>
    
                                </tr>
                                
                            </tbody>
                        </table>
                        

                        <Modal :show="showAddItemModal" @close="closeAddItemModal">
                            <div class="p-4 sm:p-10 text-center ">
                                <div class=" pr-6">
                                <h4 class="px-5 text-xl font-bold text-navy-700 dark:text-black">
                                    Feeds Consumption Details
                                </h4>
                                <hr >
                                <form @submit.prevent="submit" >
                                    <div class="px-4 py-5">
        
                                        <label class="font-semibold text-sm text-gray-600 block text-left" for="date">Date</label>
                                        <input type="date" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 "  v-model="form.date"/>
                                        <div class="text-red-600" v-if="form.errors.date">{{ form.errors.date }}</div>
        
                                        <label class="font-semibold text-sm text-gray-600 block text-left" for="feed_id">Feeds Name</label>
                                        <select name="" id="feed_id" v-model="form.feed_id" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 ">
                                            <option value="" disabled>Select Feeds</option>
                                            <option v-for="cat in feeds" :value="cat.id" :key="cat.id" >{{ cat.categories.name }}| {{ cat.supplier.name }}</option>
                                        </select>
                                        <div class="text-red-600" v-if="form.errors.feed_id">{{ form.errors.feed_id }}</div>
        
                                        <label class="font-semibold text-sm text-gray-600 block text-left" for="qty">Quantity</label>
                                        <input type="text" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 "  v-model="form.qty"/>
                                        <div class="text-red-600" v-if="form.errors.qty">{{ form.errors.qty }}</div>
               
                                    </div>
                                    <div class="mt-6 flex justify-center gap-x-4">
                                        <SecondaryButton @click="closeAddItemModal">Cancel</SecondaryButton>
                                        <PrimaryButton  @click="addItem()">Add Item</PrimaryButton>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </Modal>
                        <Modal :show="showUpdateItemModal" @close="closeUpdateItemModal">
                            <div class="p-4 sm:p-10 text-center ">
                                <div class=" pr-6">
                                <h4 class="px-5 text-xl font-bold text-navy-700 dark:text-black">
                                    Feeds Details
                                </h4>
                                <hr>
                                <form @submit.prevent="update" >
                                    <div class="px-4 py-5">
    
                                        <label class="font-semibold text-sm text-gray-600 block text-left" for="date">Date</label>
                                        <input type="date" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 "  v-model="form.date"/>
                                        <div class="text-red-600" v-if="form.errors.date">{{ form.errors.date }}</div>
    
                                        <label class="font-semibold text-sm text-gray-600 block text-left" for="feed_id">Feeds Name</label>
                                        <select name="" id="feed_id" v-model="form.feed_id" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 ">
                                            <option value="" disabled>Select Feeds</option>
                                            <option v-for="cat in feeds" :value="cat.id" :key="cat.id" >{{ cat.categories.name }}| {{ cat.supplier.name }}</option>
                                        </select>
                                        <div class="text-red-600" v-if="form.errors.feed_id">{{ form.errors.feed_id }}</div>
    
                                        <label class="font-semibold text-sm text-gray-600 block text-left" for="qty">Quantity</label>
                                        <input type="text" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 "  v-model="form.qty"/>
                                        <div class="text-red-600" v-if="form.errors.qty">{{ form.errors.qty }}</div>
    
                                    </div>
                                    <div class="mt-6 flex justify-center gap-x-4">
                                        <SecondaryButton @click="closeUpdateItemModal">Cancel</SecondaryButton>
                                        <PrimaryButton  @click="update()">Edit Consumption</PrimaryButton>
                                    </div>
                                </form>
    
                            </div>
    
                            </div>
                        </Modal>
                    </div>
                    <Pagination v-if="consumption.data.length >0" :links="consumption.links" class="mt-6 flex justify-center"/>
                </div>
            </div>
        </div>
    </SideBarLayout>

</template>

<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import moment from'moment'
import { ref, watch, onMounted } from 'vue';
import Modal  from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Pagination from '@/Components/Pagination.vue'


const form = useForm({
    qty:'',
    feed_id:'',
    date:'',
    
});
const props = defineProps({
    feeds:Object,
    consumption:Object,
    filters:Object,
    flash:Object
})
function formattedDate(date){
    return moment(date).format('MMMM   D, YYYY');
}


let showConfirm = ref(false)
let selectedConsumptionForDelete = null
let selectedConsumption = null
let deleteForm = useForm({});


const showUpdateItemModal = ref(false);
const closeUpdateItemModal = () => {
    showUpdateItemModal.value = false;
};
function closeModal(){
    showConfirm.value = false;
}

function edit(cons) {
    selectedConsumption = cons
    showUpdateItemModal.value = true;
    form.date = cons.date,
    form.feed_id = cons.feed_id,
    form.qty = cons.qty
}


const update = () =>{
    form.put('/feeds-consumption/' + selectedConsumption.id)
    form.date = "";
    form.feed_id = "";
    form.qty="";
    closeUpdateItemModal();
}

let search = ref(props.filters.search);
    watch(search, (value) => {
        router.get(
            "/feeds-consumption",
            { search: value },
            {
                preserveState: true,
                replace: true,
            }
        );
    });

const showAddItemModal = ref(false);

const openAddItemModal = () => {
  showAddItemModal.value = true;
};

const closeAddItemModal = () => {
  showAddItemModal.value = false;
};

const addItem = () => {
    form.post('/feeds-consumption/');
    form.reset();
    closeAddItemModal();
};
function submit() {
    form.post('/feeds/');
    form.qty='',
    form.description='',
    form.cat_id=''
}

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
    animation: fadeOut 6s ease-in-out forwards;
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
   
    animation: progressBar 3s linear;
}
.error .progress-bar {
    background-color: #FF5733; /* Red color */
    animation: progressBar 3s linear;
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