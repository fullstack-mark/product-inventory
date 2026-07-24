<script setup>
    import { ref, onMounted } from "vue";
    import api from "../api/axios";


    const orders = ref([]);
    const total = ref(0);

    const fetchOrders = async () => {
        try {
            const response = await api.get("/orders");
            orders.value = response.data.data;
            total.value = response.data.total;
        } catch (error) {
            console.error(error);
        }
    };

    onMounted(() => {
        fetchOrders();
    });
</script>

<template>
    <div>

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                Orders
            </h1>

            <p class="text-gray-500 mt-1">
                List of all product orders
            </p>
        </div>


        <!-- Table -->
        <div class="bg-white rounded-xl shadow border overflow-hidden"> 
            <table class="w-full text-left">

                <!-- thead -->
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-gray-600">
                            Order ID
                        </th>

                        <th class="px-6 py-3 text-gray-600">
                            Product Name
                        </th>

                        <th class="px-6 py-3 text-gray-600">
                            Price
                        </th>

                    </tr>

                </thead>

                <!-- tbody -->
                <tbody>
                    <tr
                        v-for="order in orders"
                        :key="order.order_id"
                        class="border-t hover:bg-gray-50"
                    >
                        <td class="px-6 py-4">
                            {{ order.order_id }}
                        </td>

                        <td class="px-6 py-4 font-medium">
                            {{ order.product_name }}
                        </td>

                        <td class="px-6 py-4">
                            &#8369;
                            {{ Number(order.price).toLocaleString() }}
                        </td>
                    </tr>
                </tbody>

                <!-- Summary -->
                <tfoot class="bg-gray-100">
                    <tr>
                        <td
                            colspan="2"
                            class="px-6 py-4 font-bold text-right"
                        >
                            Total
                        </td>

                        <td
                            class="px-6 py-4 font-bold text-blue-600"
                        >
                            &#8369;
                            {{ Number(total).toLocaleString() }}

                        </td>
                    </tr>
                </tfoot>

            </table>
        </div>

    </div>
</template>