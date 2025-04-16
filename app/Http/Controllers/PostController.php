namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
public function index()
{
$posts = Post::latest()->get();
return view('posts.index', compact('posts'));
}

public function create()
{
return view('posts.create');
}

public function store(Request $request)
{
$request->validate([
'title' => 'required|string|max:255',
'content' => 'required|string',
'slug' => 'required|unique:posts,slug'
]);

Post::create($request->all());

return redirect()->route('posts.index')->with('success', 'Пост створено успішно.');
}

public function edit(Post $post)
{
return view('posts.edit', compact('post'));
}

public function update(Request $request, Post $post)
{
$request->validate([
'title' => 'required|string|max:255',
'content' => 'required|string',
'slug' => 'required|unique:posts,slug,' . $post->id
]);

$post->update($request->all());

return redirect()->route('posts.index')->with('success', 'Пост оновлено успішно.');
}

public function destroy(Post $post)
{
$post->delete();

return redirect()->route('posts.index')->with('success', 'Пост видалено.');
}
}
