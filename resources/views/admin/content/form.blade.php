<!DOCTYPE html>
<html>
<head>
    <title>Edit Content</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
        body{display:flex;background:#0f172a;color:white;}
        .sidebar{width:220px;height:100vh;background:#020617;padding:25px;position:fixed;}
        .sidebar h2{margin-bottom:40px;}
        .sidebar a{display:block;color:#cbd5f5;padding:12px;margin-bottom:10px;text-decoration:none;border-radius:6px;transition:0.3s;}
        .sidebar a:hover{background:#1e293b;}
        .main{margin-left:220px;width:100%;padding:40px;}
        .card{background:#020617;border-radius:12px;padding:18px;box-shadow:0 10px 25px rgba(0,0,0,0.5);max-width:820px;}
        input,textarea,select{width:100%;padding:12px;border-radius:8px;border:1px solid #1e293b;background:#0f172a;color:white;outline:none;}
        textarea{min-height:140px;}
        label{display:block;margin-top:12px;color:#94a3b8;font-size:12px;}
        .btn{padding:12px 14px;border:none;border-radius:10px;font-weight:800;cursor:pointer;margin-top:14px;}
        .save{background:#22c55e;color:#0f172a;}
        .back{display:inline-block;margin-top:14px;color:#93c5fd;text-decoration:none;}

        @media (max-width: 768px){
            body{flex-direction:column;}
            .sidebar{position:relative;width:100%;height:auto;}
            .main{margin-left:0;padding:16px;}
            .card{padding:14px;max-width:none;}
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>🚗 Admin</h2>
        <a href="/admin/dashboard">Dashboard</a>
        <a href="/admin/content">Content</a>
        <a href="/admin/logout">Logout</a>
    </div>
    <div class="main">
        <h1 style="font-weight:500;margin-bottom:14px;">{{ $item->exists ? 'Edit' : 'Add' }} {{ ucfirst($type) }}</h1>
        <div class="card">
            <form method="POST" action="{{ $item->exists ? url('/admin/content/update/'.$item->id) : url('/admin/content/store') }}" enctype="multipart/form-data">
                @csrf
                @if(!$item->exists)
                    <input type="hidden" name="type" value="{{ $type }}">
                @endif

                <label>Title</label>
                <input name="title" value="{{ old('title', $item->title) }}" placeholder="Title">

                <label>Subtitle</label>
                <input name="subtitle" value="{{ old('subtitle', $item->subtitle) }}" placeholder="Subtitle">

                <label>Body</label>
                <textarea name="body" placeholder="Body">{{ old('body', $item->body) }}</textarea>

                <label>Sort order</label>
                <input name="sort_order" type="number" value="{{ old('sort_order', $item->sort_order ?? 0) }}">

                <label>Published</label>
                <select name="is_published">
                    <option value="1" @selected(old('is_published', $item->is_published ? 1 : 0) == 1)>Yes</option>
                    <option value="0" @selected(old('is_published', $item->is_published ? 1 : 0) == 0)>No</option>
                </select>

                <label>Image (optional)</label>
                <input type="file" name="image">

                <button class="btn save" type="submit">Save</button>
            </form>
            <a class="back" href="/admin/content?type={{ $type }}">← Back</a>
        </div>
    </div>
</body>
</html>
