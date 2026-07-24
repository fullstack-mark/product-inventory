<script setup>
    import { ref, onMounted } from "vue";
    import api from "../api/axios";

    const products = ref([]);

    const editMode = ref(false);
    const editingId = ref(null);

    const showModal = ref(false);


    const form = ref({
        product_name: "",
        product_description: "",
        quantity: 0,
        price: 0,
    });


    // Fetch products
    const fetchProducts = async () => {
        try {
            const response = await api.get("/products");
            products.value = response.data.data;
        } catch (error) {
            console.error(error);
        }
    };


    // Reset form
    const resetForm = () => {
        form.value = {
            product_name: "",
            product_description: "",
            quantity: 0,
            price: 0,
        };

        editMode.value = false;
        editingId.value = null;
    };


    // Open Add modal
    const openCreateModal = () => {
        resetForm();
        showModal.value = true;
    };


    // Close modal
    const closeModal = () => {
        showModal.value = false;
        resetForm();
    };


    // Create product
    const createProduct = async () => {
        try {
            await api.post("/products", form.value);
            fetchProducts();
            closeModal();
        } catch (error) {
            console.error(error);
        }
    };


    // Edit product
    const editProduct = (product) => {
        editMode.value = true;
        editingId.value = product.id;
        showModal.value = true;

        form.value = {

            product_name: product.product_name,

            product_description: product.product_description,

            quantity: product.quantity,

            price: product.price,

        };
    };


    // Update product
    const updateProduct = async () => {
        try {

            await api.put(
                `/products/${editingId.value}`,
                form.value
            );

            fetchProducts();
            closeModal();

        } catch (error) {
            console.error(error);
        }
    };


    // Disable product
    const disableProduct = async (id) => {

        try {
            await api.patch(`/products/${id}/disable`);
            fetchProducts();
        } catch (error) {
            console.error(error);
        }

    };


    // Enable product
    const enableProduct = async (id) => {
        try {
            await api.patch(`/products/${id}/enable`);
            fetchProducts();
        } catch (error) {
            console.error(error);
        }
    };


    onMounted(() => {
        fetchProducts();
    });


</script>

<template>
    <div>
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Products
                </h1>

                <p class="text-gray-500">
                    Manage your inventory products
                </p>
            </div>

            <!-- Add Product Button -->
            <button
                @click="openCreateModal"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 cursor-pointer"
            >
                Add Product
            </button>
        </div>

        <!-- Modal -->
        <div
            v-if="showModal"
            class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
        >


            <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6">

                <div class="flex justify-between items-center mb-5">
                    <h2 class="text-xl font-bold">
                        {{ editMode ? "Edit Product" : "Add Product" }}
                    </h2>
                    
                    <!-- Close button -->
                    <button
                        @click="closeModal"
                        class="text-gray-500 text-xl cursor-pointer"
                    >
                        ✕
                    </button>
                </div>

                <!-- Product Name -->
                 <div>
                <label class="font-bold">Product Name</label>
                <input
                    v-model="form.product_name"
                    class="border rounded-lg w-full px-4 py-2 mb-3"
                    placeholder="Ex: Rice Cooker"
                />
                </div>

                <!-- Description -->
                <div>
                    <label class="font-bold">Product Description</label>
                    <textarea
                        v-model="form.product_description"
                        class="border rounded-lg w-full px-4 py-2 mb-3"
                        placeholder="Write here..."
                    ></textarea>
                </div>

                <!-- Quantity -->
                 <div>
                    <label class="font-bold">Quantity</label>
                    <input
                        v-model="form.quantity"
                        type="number"
                        min="1"
                        class="border rounded-lg w-full px-4 py-2 mb-3"
                        placeholder="Quantity"
                    />
                </div>

                <!-- Price -->
                 <div>
                    <label class="font-bold">Price</label>
                    <input
                        v-model="form.price"
                        type="number"
                        min="0"
                        class="border rounded-lg w-full px-4 py-2 mb-5"
                        placeholder="Price"
                    />
                </div>

                <!-- Save Product Button -->
                <button
                    v-if="!editMode"
                    @click="createProduct"
                    class="bg-blue-600 text-white w-full py-2 rounded-lg cursor-pointer"
                >
                    Save Product
                </button>

                <!-- Update Product Button -->
                <button
                    v-else
                    @click="updateProduct"
                    class="bg-green-600 text-white w-full py-2 rounded-lg cursor-pointer"
                >
                    Update Product
                </button>

            </div>

        </div>

        <!-- Products Table -->
        <div class="bg-white rounded-xl shadow border overflow-hidden">
            <!-- Table -->
            <table class="w-full text-left">
                <!-- theader -->
                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-3">
                            Product Name
                        </th>


                        <th class="px-6 py-3">
                            Description
                        </th>


                        <th class="px-6 py-3">
                            Price
                        </th>


                        <th class="px-6 py-3">
                            Status
                        </th>


                        <th class="px-6 py-3">
                            Action
                        </th>


                    </tr>


                </thead>

                <!-- tbody -->
                <tbody>
                    <tr
                        v-for="product in products"
                        :key="product.id"
                        class="border-t hover:bg-gray-50"
                    >

                        <td class="px-6 py-4 font-medium">
                            {{ product.product_name }}
                        </td>

                        <td class="px-6 py-4">
                            {{ product.product_description }}
                        </td>

                        <td class="px-6 py-4">
                            &#8369;
                            {{ Number(product.price).toLocaleString() }}
                        </td>

                        <td class="px-6 py-4">
                            <span
                                v-if="product.status"
                                class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm"
                            >
                                Active
                            </span>

                            <span
                                v-else
                                class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm"
                            >
                                Disabled
                            </span>
                        </td>

                        <td class="px-6 py-4 flex gap-2">
                            <button
                                @click="editProduct(product)"
                                class="bg-yellow-500 text-white px-3 py-1 rounded cursor-pointer"
                            >
                                Edit
                            </button>

                            <button

                                v-if="product.status"

                                @click="disableProduct(product.id)"

                                class="bg-red-600 text-white px-3 py-1 rounded cursor-pointer"

                            >

                                Disable

                            </button>

                            <button
                                v-else
                                @click="enableProduct(product.id)"
                                class="bg-green-600 text-white px-3 py-1 rounded cursor-pointer"
                            >
                                Enable
                            </button>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>