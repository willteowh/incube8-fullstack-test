import React from 'react';

const BusStopItem = ({ busStop, onClick }) => (
    <div
        onClick={onClick}
        className="px-4 py-2 bg-white rounded-md shadow-md cursor-pointer hover:bg-gray-200"
    >
        <h3 className="text-lg font-semibold">{busStop.name}</h3>
        <p>{busStop.distance.toFixed(2)} km away</p>
    </div>
);

export default BusStopItem;
