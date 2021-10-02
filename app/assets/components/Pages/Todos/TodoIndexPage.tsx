import React, {useEffect, useState} from "react";
import axios from "axios";
import Spinner from "../../Common/Spinner";

type Todo = {
    name: string,
    slug: string,
}

const TodoIndexPage: React.FC = () => {
    const [readyState, setReadyState] = useState<boolean>(false);
    const [todos, setTodos] = useState<Todo[]>([]);

    useEffect(() => {
        axios.get(
            '/api/rest/v1/todos'
        ).then((response) => {
            setTodos(response.data);
            setReadyState(true);
        }).catch((error) => {
            console.error(error);
        })
    }, [])

    return (
        <div className={'w-50 mx-auto my-5'}>
            <h1 className={'text-center'}>Todo List</h1>
            {readyState ? (
                <ul className={'list-group'}>
                    {todos.map((todo) => {
                        return (
                            <li className={'list-group-item text-start shadow-sm p-3 mb-2 bg-body rounded'}
                                key={todo.slug}>{todo.name}</li>
                        )
                    })}
                </ul>
            ) : (
                <Spinner/>
            )
            }
        </div>
    )
}

export default TodoIndexPage;
