<?php

namespace App\Controllers;

use App\Controller;
use App\Auth\Models\User;
use App\Models\Content;

class HomeController extends Controller
{
    public function index()
    {
        $content = new Content();
        $contents = $content->select('id', 'title', 'details')->orderBy('id', 'desc')->get();

        return view('Controllers/view/index', ['contents' => $contents]);
    }
    public function about()
    {
        $cus = new Content();
        $contents = $cus::where('type', 'news')->find(11);

        return view('Controllers/view/about', ['contents' => $contents]);
    }
    public function allUser()
    {
        $users = [
            new User('John Doe', '<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="a6ccc9cec8e6c3dec7cbd6cac388c5c9cb">sfsd</a>'),
            new User('Jane Doe', '<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="fe949f909bbe9b869f938e929bd09d9193">sf</a>')
        ];

        $this->view('Controllers/view/user/index', ['users' => $users, 'test' => "Hello"]);
    }

    public function service()
    {
        $users = Content::where('status', 1)->orWhere('type', 'news')->get();
        return view('Controllers/view/service/index', ['users' => $users]);
    }

    public function seedContent()
    {
        $contents = [
            ['title' => 'Breaking: Major Tech Announcement', 'details' => 'Leading tech companies announce groundbreaking partnership.', 'type' => 'news', 'status' => 1],
            ['title' => 'Market Update: Stocks Rally', 'details' => 'Stock markets reach new highs amid positive economic data.', 'type' => 'news', 'status' => 1],
            ['title' => 'Sports: Championship Finals', 'details' => 'Teams compete for the championship title this weekend.', 'type' => 'news', 'status' => 1],
            ['title' => 'Health: New Research Findings', 'details' => 'Scientists discover breakthrough in medical research.', 'type' => 'news', 'status' => 1],
            ['title' => 'Weather: Storm Warning', 'details' => 'Heavy rainfall expected in coastal regions.', 'type' => 'news', 'status' => 1],
            ['title' => 'Politics: Election Results', 'details' => 'Voters elect new representatives in historic turnout.', 'type' => 'news', 'status' => 0],
            ['title' => 'Entertainment: Award Show Highlights', 'details' => 'Stars gather for annual entertainment awards ceremony.', 'type' => 'news', 'status' => 1],
            ['title' => 'Travel: New Destination Opens', 'details' => 'Exotic travel destination welcomes first tourists.', 'type' => 'news', 'status' => 1],
            ['title' => 'Technology: AI Breakthrough', 'details' => 'New AI model demonstrates unprecedented capabilities.', 'type' => 'news', 'status' => 0],
            ['title' => 'Business: Company Expansion', 'details' => 'Major corporation announces global expansion plans.', 'type' => 'news', 'status' => 1],
            ['title' => 'Science: Space Mission Launch', 'details' => 'NASA launches historic mission to Mars.', 'type' => 'news', 'status' => 1],
            ['title' => 'Education: Scholarship Program', 'details' => 'New scholarships available for students nationwide.', 'type' => 'news', 'status' => 1],
            ['title' => 'Environment: Climate Initiative', 'details' => 'World leaders commit to new environmental protections.', 'type' => 'news', 'status' => 1],
            ['title' => 'Fashion: Seasonal Trends', 'details' => 'Designers reveal latest fashion collections.', 'type' => 'news', 'status' => 1],
            ['title' => 'Food: Restaurant Awards', 'details' => 'Top chefs recognized for culinary excellence.', 'type' => 'news', 'status' => 1],
        ];

        foreach ($contents as $content) {
            Content::create($content);
        }

        echo "Content seeded successfully!";
    }

    public function whereIn()
    {
        $contents = Content::whereIn('id', [1, 2, 3, 4, 5])->get();
        return view('Controllers/view/service/whereIn', ['contents' => $contents]);
    }

    public function whereBetween()
    {
        $contents = Content::whereBetween('id', [1, 5])->get();
        return view('Controllers/view/service/whereBetween', ['contents' => $contents]);
    }

    public function createContent()
    {
        return view('Controllers/view/service/createContent');
    }

    public function storeContent()
    {
        $data = [
            'title' => $_POST['title'] ?? '',
            'details' => $_POST['details'] ?? '',
            'type' => $_POST['type'] ?? 'news',
            'status' => $_POST['status'] ?? 1
        ];

        Content::create($data);
        header('Location: /create-content?success=1');
        exit;
    }

    public function editContent()
    {
        $id = $_GET['id'] ?? 0;
        $content = Content::find($id);
        return view('Controllers/view/service/editContent', ['content' => $content]);
    }

    public function updateContent()
    {
        $id = $_POST['id'] ?? 0;
        $data = [
            'title' => $_POST['title'] ?? '',
            'details' => $_POST['details'] ?? '',
            'type' => $_POST['type'] ?? 'news',
            'status' => $_POST['status'] ?? 1
        ];

        Content::where('id', $id)->update($data);
        header('Location: /');
        exit;
    }

    public function deleteContent()
    {
        $id = $_GET['id'] ?? 0;
        Content::where('id', $id)->delete();
        header('Location: /');
        exit;
    }

    public function groupBy()
    {
        $contents = Content::select('type', 'COUNT(*) as total')
            ->groupBy('type')
            ->get();
        return view('Controllers/view/service/groupBy', ['contents' => $contents]);
    }

    public function pagination()
    {
        $page = $_GET['page'] ?? 1;
        $perPage = 5;
        $offset = ($page - 1) * $perPage;

        $contents = Content::orderBy('id', 'DESC')
            ->limit($perPage)
            ->offset($offset)
            ->get();

        return view('Controllers/view/service/pagination', ['contents' => $contents, 'page' => $page]);
    }

    public function join()
    {
        $results = User::select('user.id', 'user.name', 'user.email', 'content.title as post_title')
            ->leftJoin('content', 'user.id', '=', 'content.id')
            ->orderBy('user.id', 'DESC')
            ->limit(10)
            ->get();

        return view('Controllers/view/service/join', ['results' => $results]);
    }

    public function aggregate()
    {
        $totalUsers = User::count();
        $totalContent = Content::where('type', 'news')->count();
        $maxId = Content::max('id');
        $minId = Content::min('id');
        $avgId = Content::avg('id');

        $data = [
            'totalUsers' => $totalUsers,
            'totalContent' => $totalContent,
            'maxId' => $maxId,
            'minId' => $minId,
            'avgId' => round($avgId, 2),
        ];

        return view('Controllers/view/service/aggregate', ['data' => $data]);
    }
}
