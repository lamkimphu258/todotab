import React from 'react';
import {Zoom} from "react-awesome-reveal";

const TestimonialAside: React.FC = () => {
    return (
        <Zoom triggerOnce delay={500}>
            <aside className="text-center bg-gradient-primary-to-secondary my-5">
                <div className="container px-5">
                    <div className="row py-3 justify-content-center align-items-center">
                        <div className="col-xl-8">
                            <div className="h2 fs-1 text-white mb-4">"An intuitive solution to a common problem that we
                                all
                                face, wrapped up in a single app!"
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </Zoom>
    )
}

export default TestimonialAside;
