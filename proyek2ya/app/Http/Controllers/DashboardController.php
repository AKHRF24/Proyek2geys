<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\Questions;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Admin Dashboard
    public function adminDashboard()
    {
        $productCount = Product::count();
        $questionCount = Questions::count();
        $transactionCount = Transaction::count();

        return view('admin.page.dashboard', compact('productCount', 'questionCount', 'transactionCount'));
    }

    // User Dashboard
    public function userDashboard()
    {
        $availablePoints = auth()->user()->points;
        $products = Product::take(4)->get(); // Showcase a few products
        $latestQuestions = Questions::latest()->take(5)->get(); // Show latest quiz questions

        return view('user.page.dashboard', compact('availablePoints', 'products', 'latestQuestions'));
    }

    // Redirect to specific dashboards based on role
    public function index()
    {
        if (auth()->user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.page.dashboard');
    }
}

?>
