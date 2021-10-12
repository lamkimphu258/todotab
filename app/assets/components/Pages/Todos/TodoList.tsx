import React from "react";
import Spinner from "../../Common/Spinner";

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
}

const TodoList: React.FC<TodoListType> = ({readyState, todos}) => {
    return (
        <>
            {
                readyState ? (
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
        </>
    )
}

export default TodoList;
