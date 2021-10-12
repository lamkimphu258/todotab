import React, {FormEvent, useEffect, useState} from 'react';
import axios from "axios";
import useToken from "../../CustomHooks/useToken";

type Todo = {
    name: string
}

interface TodoCreateProps {
    todos: Todo[];
    setTodos: any;
}

const todoNameInitialState = '';

const TodoCreate: React.FC<TodoCreateProps> = ({todos, setTodos}) => {
    const [todoName, setTodoName] = useState<string>(todoNameInitialState);
    const [token,] = useToken();

    const config = {
        headers: {Authorization: `Bearer ${token}`}
    };

    const handleChange = (e: FormEvent<HTMLInputElement>) => {
        setTodoName(e.currentTarget.value);
    }

    const handleClick = () => {
        axios.post(
            `/api/rest/v1/todos`,
            {
                name: todoName,
            },
            config
        ).then((response) => {
            setTodos([...todos, {name: todoName}]);
            setTodoName(todoNameInitialState);
        }).catch((error) => {
            console.log(error);
        })
    }

    return (
        <>
            <div className="input-group mb-3">
                <input autoFocus type={'text'} className={'form-control'}
                       placeholder={'Enter your todo'} aria-label="Todo Create" aria-describedby="plus-icon"
                       onChange={handleChange} value={todoName}/>
                <span className="input-group-text" id="plus-icon">
                    <a href="#" className={"pe-auto link-dark"}>
                        <i className="fa fa-plus" onClick={handleClick}/>
                        </a>
                </span>
            </div>
        </>
    )
}

export default TodoCreate;
