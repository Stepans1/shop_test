import React from 'react';


const Select = ({id, options,defaultValue,value,onChange,watch}) => {

    return (
        <select 
        id={id}
        value={value}
        onChange={event => onChange(event.target.value)}

        >
            <option disabled value="">{defaultValue}</option>
            {options.map(option =>
                <option key={option.value} value={option.value}>
                    {option.name}
                </option>
            )}
        </select>
    );
};

export default Select;
