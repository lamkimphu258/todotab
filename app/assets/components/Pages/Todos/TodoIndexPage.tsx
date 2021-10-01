import React, {useEffect, useState} from "react";
import axios, {AxiosResponse} from "axios";

type Todo = {
    name: string,
    slug: string,
}

const TodoIndexPage: React.FC = () => {
    const [todos, setTodos] = useState<Todo[]>([]);

    useEffect(() => {
        axios.get(
            '/api/rest/v1/todos'
        ).then((response) => {
            console.log(response.data);
            setTodos(response.data);
        }).catch((error) => {
            console.log(error);
        })
    }, [])

    return (
        <div className={'w-50 mx-auto my-5'}>
            <h1 className={'text-center'}>Todo List</h1>
            <ul className={'list-group'}>
                {todos.map((todo) => {
                    return <li className={'list-group-item text-start shadow p-3 mb-2 bg-body rounded'} key={todo.slug}>{todo.name}</li>
                })}
            </ul>
        </div>
    )
}

export default TodoIndexPage;
