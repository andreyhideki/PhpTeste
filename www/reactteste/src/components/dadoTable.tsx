import {Dado} from "@/types/Dados";

type Props = {
    dados : Dado[];
}

export const DadoTable = ({ dados} : Props) =>{
    return (
      <table className="w-full border border-gray-600 rounded-md overflow-hidden">
        <thead>
            <tr className="text-left border-b border-gray-600 bg-gray-800">

                <th className="p-3">avatar</th>
                <th className="p-3">id</th>
                <th className="p-3">name</th>
                <th className="p-3">email</th>
                <th className="p-3">active</th>
                <th className="p-3">nota</th>
            </tr>
        </thead>
        <tbody>
        {dados.map(item =>(
            <tr key={item.id} className="text-gray-800 bg-gray-400 border-b border-gray-600">
                <td>
                    <img src={item.thumbnailUrl} alt={item.name} className="w-10 h-10 rounded-full mr-3"/>
                </td>
                <td>
                    {item.id}
                </td>
                <td>
                    <div>{item.name}</div>
                </td>
                <td>
                    <div>{item.email}</div>
                </td>
                <td>
                    {item.active && <div className="px-2 py-1 inline-block rounded-md border border-green-800 bg-green-600 text-white text-xs">Active</div>}
                    {!item.active && <div className="px-2 py-1 inline-block rounded-md border border-red-800 bg-red-600 text-white text-xs">Inactive</div>}
                </td>
                <td>{item.nota}</td>
            </tr>
        ))}
        </tbody>
      </table>
    );
}