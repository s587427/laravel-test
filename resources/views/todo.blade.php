@extends("layouts.app")

@section("title", "Todo")

@section("sidebaar")
    @parent
    <p>This is appended to the master sidebar.</p>
@endsection

@section("content")

    <style>


        .form-upd, .form-del{
            display: inline-block;
        }



        .todo-item .form-upd .btn-todo-edit,
        .todo-item.edit .form-upd .btn-todo-save,
        .todo-item.edit .form-upd  input[type='text'] {
            display: inline-block;
        }

        .todo-item .form-upd input[type='text'],
        .todo-item.edit input[type='checkbox'],
        .todo-item.edit span,
        .todo-item .form-upd .btn-todo-save,
        .todo-item.edit .form-upd .btn-todo-edit,
        .todo-item.edit .form-del {
            display: none;
        }


    </style>

    <div>
        <form id="todoForm" method="POST" action="/createTodo" onsubmit="onsubmit">
            @csrf
            <label for="addTodo">addTodo</label>
            <input type="text" id="addTodo" name="addTodo" value="{{ old('addTodo') }}"/>
        </form>

        <div class="flex flex-column gap-4">
             {{-- var_export($todos) --}}

             @foreach($todos as $todo)
                <div id="todo-item-{{$todo->id}}" class="todo-item">
                    <label for="todo_{{$todo->id}}">

                        <input type="checkbox" name="done" id="todo_{{$todo->id}}" {{ $todo->done == 1 ? 'checked' : ""}} />

                        <span>{{ $todo->title }}</span>

                        <!-- update -->
                        <form method="POST" class="form-upd" action="/updateTodo/{{$todo->id}}" onsubmit="onFormSubmit">
                            @csrf
                            <input type="text" name="title" value="{{ $todo->title }}" />
                            <button class="btn-todo-edit" type="button" onclick="onButtonEditTodo(this, '{{$todo->id}}')">edit</button>
                            <button class="btn-todo-save" type="button" onclick="onButtonTodoUpdateSubmit(this, '{{$todo->id}}')" data-old-value="{{ $todo->title }}">save</button>
                        </form>


                        <!-- del -->
                        <form class="form-del" action="/deleteTodo/{{$todo->id}}" onsubmit="onFormSubmit">
                            <button class="btn-todo-delete" type="button" onclick="onButtonTodoDeleteSubmit(this)">delete</button>
                        </form>

                    </label>
                </div>
            @endforeach
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        @if((session('isLoign')))
            Login
        @else
            not Login
        @endif

    </div>

    <script>

        const todoForm = document.querySelector("#todoForm")
        const addTodo = document.querySelector("#addTodo")

        todoForm.addEventListener("submit", (e) => {
            e.preventDefault()
            console.log(e);
        })

        addTodo.addEventListener("keyup", function(e){

           if(e.keyCode === 13 ){
                if((e.target.value).trim(   ) !== ""){
                    console.log(todoForm);
                    // debugger;
                    todoForm.submit()
                }else{
                    alert("請輸入代辦事項")
                }

           }

        })

        function onButtonTodoDeleteSubmit(btn){
            if(confirm("確定要刪除嗎?")){
                btn.parentNode.submit()
            }
        }

        function onButtonTodoUpdateSubmit(btn, id){

            document.querySelector(`#todo-item-${id}`).classList.toggle("edit")

            const newTitle = btn.parentNode.querySelector("input[name='title']").value

            if(newTitle !== btn.dataset.oldValue) btn.parentNode.submit()

            console.log(newTitle, btn.dataset.oldValue);


        }


        function onFormSubmit(e){
            e.preventDefault();
        }

        function onButtonEditTodo(btn, id){
            document.querySelector(`#todo-item-${id}`).classList.toggle("edit")
        }

    </script>
@endsection

