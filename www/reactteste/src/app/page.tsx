import Image from 'next/image'
import Hora from "@/components/hora";
import {DadoTable} from "@/components/dadoTable";
import {dados} from "@/data/dados";

export default function Home() {
  return (

    <main className="flex min-h-screen flex-col items-center justify-between p-24">
      <div>
        <p className="m-2 bg-blend-color">TESTEEEE</p>
        <Hora/>


      </div>

        <div className="container mx-auto">
            <h1 className="mb-5"> Lista </h1>
            <DadoTable dados={dados} />
        </div>
    </main>
  )
}
