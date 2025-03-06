

@section('content' )
    <div class="container mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Welcome to the Admin Dashboard</h1>

        <!-- 4x1 Grid Container -->
        <div class="grid-container-4x1 mb-6">
            <div class="grid grid-cols-4 gap-4">
                <!-- Revenue -->
                <div class="bg-gray-800 p-4 rounded-lg shadow-md w-full">
                    <h3 class="text-xl font-semibold mb-2">Revenue</h3>
                    <p class="text-2xl font-bold">$50,000</p>
                </div>

                <!-- Orders -->
                <div class="bg-gray-800 p-4 rounded-lg shadow-md w-full">
                    <h3 class="text-xl font-semibold mb-2">Orders</h3>
                    <p class="text-2xl font-bold">1,200</p>
                </div>

                <!-- Sales -->
                <div class="bg-gray-800 p-4 rounded-lg shadow-md w-full">
                    <h3 class="text-xl font-semibold mb-2">Sales</h3>
                    <p class="text-2xl font-bold">350</p>
                </div>

                <!-- Employees -->
                <div class="bg-gray-800 p-4 rounded-lg shadow-md w-full">
                    <h3 class="text-xl font-semibold mb-2">Employees</h3>
                    <p class="text-2xl font-bold">75</p>
                </div>
            </div>
        </div>

        <!-- 3x2 Grid Container -->
        <div class="grid-container-3x2">
            <div class="grid grid-cols-3 gap-4">
                <!-- Total Notifications -->
                <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Total Notifications</h3>
                    <p class="text-2xl font-bold" id="totalNotifications">0</p>
                </div>
                <!-- Active Users -->
                <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Active Users</h3>
                    <p class="text-2xl font-bold" id="activeUsers">0</p>
                </div>
                <!-- New Users Today -->
                <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2">New Users Today</h3>
                    <p class="text-2xl font-bold" id="newUsersToday">0</p>
                </div>
                <!-- System Health -->
                <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2">System Health</h3>
                    <p class="text-2xl font-bold" id="systemHealth">N/A</p>
                </div>
                <!-- Total Posts -->
                <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Total Posts</h3>
                    <p class="text-2xl font-bold" id="totalPosts">0</p>
                </div>
                <!-- Pending Approvals -->
                <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Pending Approvals</h3>
                    <p class="text-2xl font-bold" id="pendingApprovals">0</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* 4x1 Grid Container Styling */
.grid-container-4x1 {
    margin-bottom: 2rem; /* Space between grids */
}

.grid-container-4x1 .grid {
    grid-template-columns: repeat(4, 1fr); /* 4 equal columns */
    gap: 1rem; /* Gap between the grid items */
}


.grid-container-4x1 .grid div {
    background-color: #2d3748; /* Dark gray background */
    padding: 2rem; /* Padding inside each card */
    border-radius: 0.375rem; /* Rounded corners */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    text-align: center; /* Center text */
    color: white; /* Text color */
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth hover effects */
}

.grid-container-4x1 .grid div:hover {
    transform: translateY(-5px); /* Slight lift effect on hover */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
}

.grid-container-4x1 .grid h3 {
    font-size: 1.25rem; /* Font size for the titles */
    font-weight: 600; /* Bold */
    margin-bottom: 0.5rem; /* Space below the title */
    color: white;
}

.grid-container-4x1 .grid p {
    font-size: 1.875rem; /* Larger font size for the value */
    font-weight: 700; /* Bold value */
}

/* 3x2 Grid Container Styling */
.grid-container-3x2 {
    margin-top: 2rem; /* Space between the 4x1 and 3x2 grids */
}

.grid-container-3x2 .grid {
    grid-template-columns: repeat(3, 1fr); /* 3 equal columns */
    gap: 1rem; /* Gap between the grid items */
}

.grid-container-3x2 .grid div {
    background-color: #060607; /* Dark gray background */
    padding: 2rem; /* Padding inside each card */
    border-radius: 0.375rem; /* Rounded corners */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    text-align: center; /* Center text */
    color: white; /* Text color */
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth hover effects */
}

.grid-container-3x2 .grid div:hover {
    transform: translateY(-5px); /* Slight lift effect on hover */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
}

.grid-container-3x2 .grid h3 {
    font-size: 1.25rem; /* Font size for the titles */
    font-weight: 600; /* Bold */
    margin-bottom: 0.5rem; /* Space below the title */
    color: green;
}

.grid-container-3x2 .grid p {
    font-size: 1.875rem; /* Larger font size for the value */
    font-weight: 700; /* Bold value */
}

/*Dashboard logo*/

/* Sidebar Logo Styling */
.logo-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 1.5rem; /* Adjust the space below the logo */
}

.logo-container img {
    max-height: 64px; /* Adjust logo height */
    width: auto; /* Maintain aspect ratio */
}

/* Sidebar links container */
aside ul {
    margin-top: 1rem; /* Space between the logo and links */
}

/* Optional: You can adjust the spacing between the links further if needed */
aside ul li {
    margin-top: 1rem;
}

    </style>

    <script>
        // Example Data (you can replace these values with real-time dynamic data)
        const dashboardData = {
            totalNotifications: 15,
            activeUsers: 120,
            newUsersToday: 25,
            systemHealth: '98% Uptime',
            totalPosts: 250,
            pendingApprovals: 5
        };

        // Populate cards with data
        document.getElementById("totalNotifications").innerText = dashboardData.totalNotifications;
        document.getElementById("activeUsers").innerText = dashboardData.activeUsers;
        document.getElementById("newUsersToday").innerText = dashboardData.newUsersToday;
        document.getElementById("systemHealth").innerText = dashboardData.systemHealth;
        document.getElementById("totalPosts").innerText = dashboardData.totalPosts;
        document.getElementById("pendingApprovals").innerText = dashboardData.pendingApprovals;
    </script>
@endsection
