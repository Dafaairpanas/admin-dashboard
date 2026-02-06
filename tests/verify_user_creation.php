<?php

// Verification script for user creation fix
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Queries\QUser;
use App\Queries\QRole;

echo "=== Testing User Creation Fix ===\n\n";

try {
    // Get a role to use for testing
    $params = (object) ['search_value' => null, 'show_data' => 1];
    $roles = QRole::getAll($params);

    if (empty($roles['items'])) {
        echo "ERROR: No roles found in database. Please create a role first.\n";
        exit(1);
    }

    $testRole = $roles['items'][0];
    echo "Using role: {$testRole->name} (ID: {$testRole->id})\n\n";

    // Prepare test data
    $testData = [
        'name' => 'Test User ' . time(),
        'email' => 'testuser' . time() . '@example.com',
        'role_id' => $testRole->id,
        'password' => 'password123'
    ];

    echo "Attempting to create user:\n";
    echo "  Name: {$testData['name']}\n";
    echo "  Email: {$testData['email']}\n";
    echo "  Role ID: {$testData['role_id']}\n\n";

    // Attempt to create user
    $result = QUser::saveData($testData);

    if ($result && isset($result['items'])) {
        echo "✓ SUCCESS: User created successfully!\n";
        echo "  User ID: {$result['items']->id}\n";
        echo "  Name: {$result['items']->name}\n";
        echo "  Email: {$result['items']->email}\n\n";

        // Clean up - delete the test user
        echo "Cleaning up test user...\n";
        QUser::deleteData($result['items']->id);
        echo "✓ Test user deleted.\n\n";

        echo "=== VERIFICATION PASSED ===\n";
        exit(0);
    } else {
        echo "✗ FAILED: User creation returned unexpected result.\n";
        exit(1);
    }

} catch (\Exception $e) {
    echo "✗ ERROR: " . $e->getMessage() . "\n";
    echo "\nStack trace:\n" . $e->getTraceAsString() . "\n";
    exit(1);
}
