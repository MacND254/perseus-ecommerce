@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-semibold mb-6">Welcome to the Admin Dashboard</h1>

    <!-- Top Grid (4x1 on large screens, adjusts for smaller screens) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-gray-800 p-6 rounded-lg shadow-md text-center transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg hover:shadow-green-400/50">
            <h3 class="text-lg font-semibold">Revenue</h3>
            <p class="text-2xl font-bold">$50,000</p>
        </div>
        <div class="bg-gray-800 p-6 rounded-lg shadow-md text-center transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg hover:shadow-green-400/50">
            <h3 class="text-lg font-semibold">Orders</h3>
            <p class="text-2xl font-bold">1,200</p>
        </div>
        <div class="bg-gray-800 p-6 rounded-lg shadow-md text-center transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg hover:shadow-green-400/50">
            <h3 class="text-lg font-semibold">Sales</h3>
            <p class="text-2xl font-bold">350</p>
        </div>
        <div class="bg-gray-800 p-6 rounded-lg shadow-md text-center transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg hover:shadow-green-400/50">
            <h3 class="text-lg font-semibold">Employees</h3>
            <p class="text-2xl font-bold">75</p>
        </div>
    </div>

    <!-- Bottom Grid (3x2 on large screens, adjusts for smaller screens) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <div class="bg-gray-800 p-6 rounded-lg shadow-md text-center transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg hover:shadow-green-400/50">
            <h3 class="text-lg font-semibold text-green-400">Total Notifications</h3>
            <p class="text-2xl font-bold" id="totalNotifications">0</p>
        </div>
        <div class="bg-gray-800 p-6 rounded-lg shadow-md text-center transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg hover:shadow-green-400/50">
            <h3 class="text-lg font-semibold text-green-400">Active Users</h3>
            <p class="text-2xl font-bold" id="activeUsers">0</p>
        </div>
        <div class="bg-gray-800 p-6 rounded-lg shadow-md text-center transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg hover:shadow-green-400/50">
            <h3 class="text-lg font-semibold text-green-400">New Users Today</h3>
            <p class="text-2xl font-bold" id="newUsersToday">0</p>
        </div>
        <div class="bg-gray-800 p-6 rounded-lg shadow-md text-center transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg hover:shadow-green-400/50">
            <h3 class="text-lg font-semibold text-green-400">System Health</h3>
            <p class="text-2xl font-bold" id="systemHealth">N/A</p>
        </div>
        <div class="bg-gray-800 p-6 rounded-lg shadow-md text-center transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg hover:shadow-green-400/50">
            <h3 class="text-lg font-semibold text-green-400">Total Posts</h3>
            <p class="text-2xl font-bold" id="totalPosts">0</p>
        </div>
        <div class="bg-gray-800 p-6 rounded-lg shadow-md text-center transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg hover:shadow-green-400/50">
            <h3 class="text-lg font-semibold text-green-400">Pending Approvals</h3>
            <p class="text-2xl font-bold" id="pendingApprovals">0</p>
        </div>
    </div>
</div>

<script>
    // Example Data (replace these with dynamic data)
    const dashboardData = {
        totalNotifications: 15,
        activeUsers: 120,
        newUsersToday: 25,
        systemHealth: '98% Uptime',
        totalPosts: 250,
        pendingApprovals: 5
    };

    // Populate dashboard
    document.getElementById("totalNotifications").innerText = dashboardData.totalNotifications;
    document.getElementById("activeUsers").innerText = dashboardData.activeUsers;
    document.getElementById("newUsersToday").innerText = dashboardData.newUsersToday;
    document.getElementById("systemHealth").innerText = dashboardData.systemHealth;
    document.getElementById("totalPosts").innerText = dashboardData.totalPosts;
    document.getElementById("pendingApprovals").innerText = dashboardData.pendingApprovals;
</script>
@endsection
