import Image from 'next/image'
import Hora from "@/components/hora";

export default function Home() {
  return (
    <main className="flex min-h-screen flex-col items-center justify-between p-24">
      <div>
        <p className="m-2 bg-blend-color">TESTEEEE</p>
        <Hora/>
      </div>
    </main>
  )
}
