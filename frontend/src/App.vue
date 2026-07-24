<template>
    <div class="min-h-screen bg-gray-100">

        <!-- Header -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <h1 class="text-2xl font-bold text-gray-800">
                    Product Inventory
                </h1>
            </div>
        </header>

        <!-- Navigation -->
        <nav class="bg-white border-b">

            <div class="max-w-7xl mx-auto px-6 py-3 flex gap-4">

                <router-link
                    to="/products"
                    class="px-4 py-2 rounded"
                    active-class="bg-green-600 text-white"
                >
                    Products
                </router-link>


                <router-link
                    to="/orders"
                    class="px-4 py-2 rounded"
                    active-class="bg-green-600 text-white"
                >
                    Orders
                </router-link>

            </div>

        </nav>

        <!-- Content -->
        <main class="max-w-7xl mx-auto p-6">
            <router-view />
        </main>

    </div>
</template>