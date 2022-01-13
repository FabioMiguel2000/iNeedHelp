@extends('layouts.navbar')

@section('content')
    <style>
        .title {
            padding-bottom: 1rem;
        }

        .parameter {
            margin-bottom: 1rem;
        }

        .parameter p {
            font-size: 0.7em;
            margin-bottom: 0;
        }

        .parameter label {
            font-weight: bold;
        }

        .parameter input,
        .parameter textarea {
            font-size: 0.8em;
        }



        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        .tag-wrapper * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        ::selection {
            color: #fff;
            background: #5372F0;
        }

        .tag-wrapper {
            width: 100%;
            background: #fff;
            border-radius: 10px;
            /* padding: 18px 25px 20px; */
            /* box-shadow: 0 0 30px rgba(0, 0, 0, 0.06); */
        }

        .tag-wrapper :where(.tag-title, li, li i, .tag-details) {
            display: flex;
            align-items: center;
        }

        .tag-title img {
            max-width: 21px;
        }

        .tag-title h2 {
            font-size: 21px;
            font-weight: 600;
            margin-left: 8px;
        }

        .tag-wrapper .tag-content {
            margin: 10px 0;
        }

        .tag-content p {
            font-size: 15px;
        }

        .tag-content ul {
            display: flex;
            flex-wrap: wrap;
            padding: 5px;
            margin: 12px 0;
            border-radius: 5px;
            border: 1px solid #a6a6a6;
        }

        .tag-content ul li {
            color: #333;
            margin: 4px 3px;
            list-style: none;
            border-radius: 5px;
            background: #F2F2F2;
            padding: 5px 8px 5px 10px;
            border: 1px solid #e3e1e1;
        }

        .tag-content ul li i {
            height: 20px;
            width: 20px;
            margin-left: 8px;
            font-size: 12px;
            cursor: pointer;
            border-radius: 50%;
            justify-content: center;
        }

        .tag-content ul input {
            flex: 1;
            padding: 5px;
            border: none;
            outline: none;
            font-size: 16px;
        }

        .tag-wrapper .tag-details {
            justify-content: space-between;
        }

        .tag-details button {
            border: none;
            outline: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .tag-details button:hover {
            background: #2c52ed;
        }

    </style>

    <div class="container">
        <div class="title">
            <h1>Ask a question</h1>
            <p>Here you can create your question</p>
        </div>


        <form style="margin:auto;" action="{{ route('new-question') }}" method="post">
            @csrf

            <div class="parameter">
                <label for="title">Question Title</label>
                <p>Be specific and imagine you’re asking a question to another person</p>
                <input name="title" type="text" id="title" class="form-control"
                    placeholder="Try to insert a brief description of the problem while including the more relevant aspects"
                    minlength="10" maxlength="100" required>
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="parameter">
                <label for="content">Content</label>
                <p>Include all the information someone would need to answer your question</p>
                <textarea name="content" class="form-control" id="content" rows="10" minlength="10" maxlength="10000"
                    required></textarea>
                @error('content')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="parameter" style="display: none;">
                <label for="tags">Tags</label>
                <p>
                    Add up to 5 tags to describe what your question is about (note: insert tags separated by commas)
                </p>
                <input name="tags" type="text" id="hidden-tags-form" class="form-control" placeholder="e.g.(Java, VPN, exampleTag)" >
            </div>
            <div style="display: none;">
                <button type="submit" class="btn btn-primary mt-1" id="hidden-submit-btn" >Post Question</button>
            </div>

        </form>

        <div class="tag-wrapper parameter">
            <label for="tags">Tags</label>
            <p>Add up to 5 tags to describe what your question is about (note: insert tags and press enter)</p>
            <div class="tag-content">
                {{-- <p>Add up to 5 tags to describe what your question is about (note: insert tags separated by commas)</p> --}}
                <ul><input type="text" spellcheck="false" name = "temp-tags" placeholder="e.g.(Java, VPN, exampleTag)"></ul>
            </div>
            <div class="tag-details">
                <p><span style="font-weight: bold;">5</span> tags are remaining</p>
            </div>
        </div>
        <div style="margin-bottom: 4em;">
            <button type="submit" class="btn btn-primary mt-1" id="submit-btn">Post Question</button>
        </div>

    </div>
    <script>
        const ul = document.querySelector(".tag-wrapper ul"),
            input = document.querySelector(".tag-wrapper input"),
            tagNumb = document.querySelector(".tag-details span");
        let maxTags = 5,
            tags = [];
        countTags();
        createTag();

        function countTags() {
            input.focus();
            tagNumb.innerText = maxTags - tags.length;
            if(maxTags - tags.length == 0){
                input.readOnly = true;
                input.placeholder ="";
            }
            else{
                input.readOnly = false;
                input.placeholder="e.g.(Java, VPN, exampleTag)"
            }
        }

        function createTag() {
            ul.querySelectorAll(".tag-wrapper li").forEach(li => li.remove());
            tags.slice().reverse().forEach(tag => {
                let liTag = `<li>${tag} <i class="bi bi-x-circle" onclick="remove(this, '${tag}')"></i></li>`;
                ul.insertAdjacentHTML("afterbegin", liTag);
            });
            countTags();
        }

        function remove(element, tag) {
            let index = tags.indexOf(tag);
            tags = [...tags.slice(0, index), ...tags.slice(index + 1)];
            element.parentElement.remove();
            countTags();
        }

        function addTag(e) {
            if (e.key == "Enter") {
                let tag = e.target.value.replace(/\s+/g, ' ');
                if (tag.length > 0 && !tags.includes(tag)) {
                    if (tags.length < 5) {
                        tag.split(',').forEach(tag => {
                            tags.push(tag);
                            createTag();
                        });
                    }
                }
                e.target.value = "";
            }
        }
        input.addEventListener("keyup", addTag);
        let submit_btn = document.getElementById("submit-btn")
        submit_btn.addEventListener("click", ()=>{
            let temp = document.getElementById("hidden-tags-form").value = tags;
            document.getElementById("hidden-submit-btn").click();
        })

    </script>
    @include('layouts.footerbar')
@endsection
