import React from 'react';

const ContentContainer: React.FC = ({children}) => {
    return (
        <div className={'content'}>
            {children}
        </div>
    )
}

export default ContentContainer;
