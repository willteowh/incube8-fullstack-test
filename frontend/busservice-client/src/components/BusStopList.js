import React from 'react';
import BusStopItem from './BusStopItem';

const BusStopList = ({ busStops, onBusStopClick }) => (
    <div className="mt-6 space-y-4">
        {busStops.map((busStop, index) => (
            <BusStopItem
                key={index}
                busStop={busStop}
                onClick={() => onBusStopClick(busStop)}
            />
        ))}
    </div>
);

export default BusStopList;
