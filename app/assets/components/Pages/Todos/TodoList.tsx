import React from "react";
import Spinner from "../../Common/Spinner";
import useToken from "../../CustomHooks/useToken";
import axios from "axios";

type DateTimeUTC = {
    date: string,
    timezone: string,
    timezone_type: number,
}

type Todo = {
    name: string;
    slug: string;
    createdAt: DateTimeUTC;
    updatedAt: DateTimeUTC;
}

type TodoListType = {
    readyState: boolean;
    todos: Todo[];
    setTodos: any;
}

const TodoList: React.FC<TodoListType> = ({readyState, todos, setTodos}) => {
    const [token,] = useToken();

    const config = {
        headers: {Authorization: `Bearer ${token}`}
    };

    const handleDelete = (slug: string) => {
        let todosTemp = [...todos];
        axios.delete(
            `/api/rest/v1/todos/${slug}`,
            config
        ).then((response) => {
            todosTemp = todosTemp.flatMap(
                (todo) => todo.slug === slug ? [] : [todo]
            );
            setTodos(todosTemp);
        }).catch((error) => {
            console.log(error);
        })
    }

    return (
        <>
            {
                readyState ? (
                    <ul className={'list-group'}>
                        {todos.map((todo) => {
                            return (
                                <li className={'list-group-item text-start shadow-sm p-3 mb-2 bg-body rounded'}
                                    key={todo.slug}>
                                    <div className="d-flex justify-content-between">
                                        <div>{todo.name}</div>
                                        <div onClick={() => handleDelete(todo.slug)}>
                                            <a href="#" className={'pe-auto text-dark'}>
                                                <i className="fas fa-trash-alt"/>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            )
                        })}
                    </ul>
                ) : (
                    <Spinner/>
                )
            }
        </>
    )
}

export default TodoList;
